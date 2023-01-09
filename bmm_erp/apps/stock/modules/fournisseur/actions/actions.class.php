<?php

require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorHelper.class.php';

/**
 * fournisseur actions.
 *
 * @package    Bmm
 * @subpackage fournisseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fournisseurActions extends autoFournisseurActions {
    
    //______________________________________________________________________Ajouter fournisseur
    public function executeAjoutfournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "" || $ref != "") {
                $fournisseur = new Fournisseur();
                $q = Doctrine_Query::create()
                        ->select("*")
                        ->from('fournisseur');
                if ($frs != "")
                    $q = $q->where("rs like '%" . $frs . "%'");
                if ($ref != "")
                    $q = $q->where("reference like '%" . $ref . "%'");
                if ($frs != "" && $ref != "")
                    $q = $q->where("rs like '%" . $frs . "%'")
                            ->Orwhere("reference like '%" . $ref . "%'");
                //die($q);
                $frss = $q->execute();

                if (count($frss) > 0)
                    $fournisseur = $frss[0];
              //  die(count($frss).'---'.$q);
                $fournisseur->setRs($frs);
                $fournisseur->setReference($ref);
                $fournisseur->save();
                if (!$frss)
                    die('Succès d\'ajout');
                else
                    die('Mise à jour fiche fournisseur');
            }
        }
        die('Erreur d\'ajout');
    }

}
