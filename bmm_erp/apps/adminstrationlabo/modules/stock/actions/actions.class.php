<?php

require_once dirname(__FILE__) . '/../lib/stockGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/stockGeneratorHelper.class.php';

/**
 * stock actions.
 *
 * @package    Bmm
 * @subpackage stock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockActions extends autoStockActions
{

    public function executeMisajourstock(sfWebRequest $request)
    {

        $stockpatrimoines = new Stock();
        $stockpatrimoines->MisAJourStockPatrimoine();
        $this->redirect('stock/index');
    }

    public function executeGetListedemandeappParLabo(sfWebRequest $request)
    {$user = $this->getUser()->getAttribute('userB2m');
        $ids = json_decode($user->getIdMagasin());

        $query = "select documentachat.id as id,
        LPAD(documentachat.numero::text, 7, '0') as numero, naturedocachat.code as type"
        . " from documentachat,naturedocachat  "
        . " where documentachat.id_typedoc= 4"
        . " and  documentachat.id_naturedoc = 6 "
        . " and documentachat.id_etatdoc = 92"
        . " and naturedocachat.id =documentachat.id_naturedoc"
        . " and   id_emplacement IN (" . implode(',', array_map('intval', $ids)) . ") "
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }
    public function executeListesbcommnadeinterneLabo(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['iddemandeur'];
            $query = "SELECT    concat(trim(typedoc.prefixetype),
              lpad(documentachat.numero::text,7,'0')) as numero , "
                . "documentachat.mntttc, documentachat.id    "
                . " FROM    documentachat,    typedoc"
                . " WHERE    documentachat.id_typedoc = typedoc.id   "
                . " and  documentachat.id_typedoc=4 "
                . " and documentachat.id_naturedoc =6 "

                . "and  documentachat.id_demandeur=" . $iddemandeur . ""
                . " order by id desc;";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listesdocs = $conn->fetchAssoc($query);

            die(json_encode($listesdocs));
        }
        die('bien');
    }
    public function executeRenvoyeaulabopasstock(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $doc_bci_magasin = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            if ($doc_bci_magasin) {
                $doc_bci_magasin->setIdEtatdoc(85);
            }

            $doc_bci_magasin->save();
            die('iddoc/' . $doc_bci_magasin->getId());
        }
    }
    public function executeSavedocumentsortie(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 11;
            $iddoc = $params['iddoc'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();
            $doc_bci_magasin = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedoc(intval($numero), $idtypedoc);
            if ($doc) {
                $documentachat = $doc;
            }
            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);
            $documentachat->setIdDocparent($iddoc);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            //______________________________________Bon entrer et listes des prix
            $enteteprix = $params['docentete'];
            $documentachat->setMntttc($enteteprix['ttcnet']);
            //______________________________________Fournisseur
            $iddemandeur = $params['iddemandeur'];
            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->save();
            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $idarticle = $lignedoc['idarticle'];
                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $puorigine = $lignedoc['puorigine'];
                $puht = $lignedoc['puht'];
                $idmag = $lignedoc['idmag'];
                $mntttc = $lignedoc['mntttc'];

                $idligne = $lignedoc['idligne'];
                $iddoc = $documentachat->getId();

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                if ($norgdre) {
                    $lignedoc->setNordre($norgdre);
                }

                if ($idmag) {
                    $lignedoc->setIdMag($idmag);
                }

                if ($idligne) {
                    $lignedoc->setIdLigneparent($idligne);
                }

                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                $art = new Article();
                if ($idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneById($idarticle);
                       $this->SaveMouvementStockSortie($article, $qte, $puht, $numero, $documentachat);
                }
                if ($codearticle != "" && !$idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                }

                if ($article) {
                    $lignedoc->setIdArticlestock($article->getId());
                    $art = $article;
                    //______________________________________________________________Tarification

                    $lignedoc->setMntttc(floatval($mntttc));
                    $lignedoc->setPamp(floatval($mntttc));
                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp

                    $lignedoc->save();
                    //______________________________________________________________Qte
                    $art->UpdateStock($qte);
                } else {
                    die('Erreur');
                }
            }
            if ($doc_bci_magasin) {
                $doc_bci_magasin->setIdEtatdoc(93);
            }

            $doc_bci_magasin->save();
            die('iddoc/' . $documentachat->getId());
        }
    }
    public function SaveMouvementStockSortie($article, $qte_sortie, $prix_unitaire, $numero, $documentachat)
    {
        $exercie = date('Y');
        // $entete = MouvemententetestockTable::getInstance()->findOneByExercice($exercie);
        // if (!$entete) {
        $entete = new Mouvemententetestock();
        $numero_entre = 'B.Sortie' . sprintf('%05d', $numero);
        $entete->setLibelle($numero_entre);
        $entete->setExercice($exercie);
        $entete->setIdDocachat($documentachat->getId());
        $entete->save();
        // }
        $lignes = LignemouvemententetestockTable::getInstance()->findOneByIdArticleAndLibelleAndIdMouvement($article->getId(), 'STOCK INITIAL', $entete->getId());
        if (!$lignes) {
            $lignes = new Lignemouvemententetestock();
            $lignes->setCreatedAt(date('Y-m-d'));
            $lignes->setIdArticle($article->getId());
            $lignes->setIdMouvement($entete->getId());
            $numero_entre = 'B.Sortie' . sprintf('%05d', $numero);
            $lignes->setLibelle($numero_entre);
            $lignes->setQteSortie($qte_sortie);
            if ($prix_unitaire) {
                $lignes->setPuachat($prix_unitaire);
            }
            if ($prix_unitaire) {
                $lignes->setCump($prix_unitaire);
            }
            $lignes->setStockValeur($qte_sortie * $prix_unitaire);
            $lignes->save();
        }
    }
}
