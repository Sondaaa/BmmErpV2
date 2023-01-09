<?php

require_once dirname(__FILE__).'/../lib/tachesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tachesGeneratorHelper.class.php';

/**
 * taches actions.
 *
 * @package    Bmm
 * @subpackage taches
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tachesActions extends autoTachesActions
{
    //________________ajouter taches 
     public function executeSavetache(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $poste = $params['poste'];
             if ($libelle != "" || $poste != "") {
                $taches = new Taches();
                $q = Doctrine_Query::create()
                        ->select("*")
                        ->from('taches');
                if ($libelle != "")
                    $q = $q->where("libelle like '%" . $libelle . "%'");
//                if ($poste != "")
//                    $q = $q->where("id_posterh like '%" . $poste . "%'");
//                if ($frs != "" && $ref != "")
//                    $q = $q->where("libelle like '%" . $libelle . "%'")
//                            ->Orwhere("id_posterh like '%" . $poste . "%'");
                //die($q);
               // $frss = $q->execute();

//                if (count($frss) > 0)
//                    $fournisseur = $frss[0];
                //  die(count($frss).'---'.$q);
                $taches->setLibelle($libelle);
                $taches->setIdPosterh($poste);
               
                $taches->save();

                die($taches->getId() . ',' . $taches->getPosterh());
            }
        }
        die('Erreur d\'ajout');
    }
}
