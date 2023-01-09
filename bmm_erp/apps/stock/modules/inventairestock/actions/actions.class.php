<?php

require_once dirname(__FILE__) . '/../lib/inventairestockGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/inventairestockGeneratorHelper.class.php';

/**
 * inventairestock actions.
 *
 * @package    Bmm
 * @subpackage inventairestock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inventairestockActions extends autoInventairestockActions {

    //__________________________________________________________________________Ouvrir fiche inventaire
    public function executeOuvrir(sfWebRequest $request) {

        if ($request->getParameter('mag') && $request->getParameter('mag') != "") {
            header('Access-Control-Allow-Origin: *');
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $inventaire = new Inventairestock();
            $invs = Doctrine_Core::getTable('inventairestock')
                    ->createQuery('a')->where('id_mag=' . $request->getParameter('mag'))
                    ->andWhere('datefermeture is  null');

            $invs = $invs->execute();
            if (count($invs) <= 0) {
                $query = "SELECT stock.id as idstock, article.id as idart,  article.codeart, magasin.libelle,   article.designation "
                        . ",stock.qtereel,stock.qtetheorique "
                        . "FROM    article,    stock,magasin   "
                        . "WHERE    stock.id_article = article.id  "
                        . " AND magasin.id=stock.id_mag "
                        . "AND   (stock.qtereel > 0 OR  stock.qtetheorique > 0 ) "
                        . "AND    stock.id_mag =" . $request->getParameter('mag') . " ";
            } else {
                $query = "SELECT  stock.id as idstock, ligneinventaire.qtetheorique,  "
                        . " ligneinventaire.ecartreel, "
                        . "  article.codeart, COALESCE(ecartthorique,0) as ecartthorique ,  "
                        . "article.designation,   magasin.libelle,   article.id as idart "
                        . "FROM   article,   ligneinventaire,   inventairestock,   magasin ,stock "
                        . "WHERE   stock.id_article=article.id and"
                        . "  stock.id_mag=magasin.id and "
                        . " ligneinventaire.id_article = article.id "
                        . "AND   ligneinventaire.id_inventaire = inventairestock.id "
                        . "AND    magasin.id = inventairestock.id_mag "
                        . "AND magasin.id=" . $request->getParameter('mag') . " ";
            }

            $listesdocs = $conn->execute($query);

            $this->stocks = $listesdocs;

            if (count($invs) > 0)
                $inventaire = $invs[count($invs) - 1];
            else {
                $inventaire->setDatedepart(date('d-m-Y'));
                $inventaire->setIdMag($request->getParameter('mag'));
                $inventaire->save();
                $inventaire->setNumero($inventaire->getNumeroseqfiche());
                $inventaire->save();
            }
            $this->inventaire = $inventaire;
        } else {
            $this->stocks = null;
            $this->stocks2 = null;
        }
    }

    ////__________________________________________________________________________Détail
    public function executeDetail(sfWebRequest $request) {

        if ($request->getParameter('iddoc')) {


            $inventaire = new Inventairestock();
            $invs = Doctrine_Core::getTable('inventairestock')->findOneById($request->getParameter('iddoc'));
            $inventaire = $invs;

            $ligneinventaire = Doctrine_Core::getTable('ligneinventaire')->findByIdInventaire($request->getParameter('iddoc'));


            $this->lignes = $ligneinventaire;
            $this->inventaire = $inventaire;
        }
    }

    //__________________________________________________mis ajour ligne inventaire
    public function executeMisajourligne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $qtetheorique = $params['qtetheorique'];
            $idligne = $params['idligne'];
            $qte = $params['qte'];
            $idstock = $params['idstock'];
            Doctrine_Query::create()
                    ->update('ligneinventaire')
                    ->set('ecartthorique', $qte)
                    ->where('id=' . $idligne)
                    ->execute();
            $ecart =  $qte-$qtetheorique ;
            $st = new Stock();
            $stk = Doctrine_Core::getTable('stock')->findOneById($idstock);
            $ligneInv = Doctrine_Core::getTable('ligneinventaire')->findOneById($idligne);
            $st = $stk;
            $qteentre = $st->getEntreeStock(date('Y-m-d'), $st->getIdMag());
            $qtesortie = $st->getSortieStock(date('Y-m-d'), $st->getIdMag());
            $qtetotal = $qte + $qteentre - $qtesortie;
            $chaine = "Ecart: " . $ecart . '<br>';
            $chaine.= "Entrée : " . $qteentre . '<br>';
            $chaine.= "Sortie : " . $qtesortie . '<br>';
            $chaine.= "Qte final: " . $qtetotal;
            $ligneInv->setEcartreel($qtetotal);
            $ligneInv->save();
            die($chaine);
        }
        die('Erreur');
    }

    //__________________________________________________mis ajour ligne inventaire
    public function executeFermer(sfWebRequest $request) {

        //______________________________________________________________________Mis ajour ligne Inventaire
        $inv = new Inventairestock();
        $inventaire = Doctrine_Core::getTable('inventairestock')->findOneById($request->getParameter('id'));
        $inv = $inventaire;
        $ligne = new Ligneinventaire();
        $lignes = $inv->getLigneinventaire();
        foreach ($lignes as $lg) {
            $ligne = $lg;
            $stock = new Stock();
            $article = new Article();
            $article = $ligne->getArticle();
            $artstock = Doctrine_Core::getTable('stock')->findOneByIdArticleAndIdMag($article->getId(), $inv->getIdMag());
            $stock = $artstock;
            if ($ligne->getEcartreel()) {
                $stock->setQtereel($ligne->getEcartreel());
                $stock->setQtetheorique($ligne->getEcartreel());
                $stock->save();
                $listestock = Doctrine_Core::getTable('ligneinventaire')->findByIdArticle($article->getId());
                $qte_acctueil = 0;

                foreach ($listestock as $liste) {
                    if ($liste->getEcartreel())
                        $qte_acctueil += $liste->getEcartreel();
                }
                $article->setQtetheorique($qte_acctueil);
                $article->setStockreel($qte_acctueil);
                $article->save();
            }
        }
        //______________________________________________________________________Fermer Inventaire
        $query = Doctrine_Query::create()
                ->update('inventairestock')
                ->set('datefermeture', '?', date('Y-m-d'))
                ->where('id=' . $request->getParameter('id'));
        $query = $query->execute();
        $this->Redirect('inventairestock/index');
    }

}
