<?php

require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorHelper.class.php';

/**
 * caissesbanques actions.
 *
 * @package    Bmm
 * @subpackage caissesbanques
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class caissesbanquesActions extends autoCaissesbanquesActions {

    public function executeSavespiecepreengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);


            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = $params['date'];
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
            $ligne = new Ligneoperationcaisse();
            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                // die($lignesbudgets);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            $ligne->setNumeroo($numero);
            $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            $ligne->setIdCaisse($id_caisse);
            $ligne->setIdDocachat($iddoc_achat);
            $ligne->setObjet($objet);
            $ligne->setDateoperation($date);
            $ligne->setIdCategorie($idCatoperation);
            $ligne->setMntoperation($mnt);
            if ($chequen)
                $ligne->setChequen($chequen);
            $ligne->save();
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }

            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            die('bien');
        }
    }

}
