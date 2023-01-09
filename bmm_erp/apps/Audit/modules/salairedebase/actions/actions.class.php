<?php

require_once dirname(__FILE__) . '/../lib/salairedebaseGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/salairedebaseGeneratorHelper.class.php';

/**
 * salairedebase actions.
 *
 * @package    Bmm
 * @subpackage salairedebase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class salairedebaseActions extends autoSalairedebaseActions {

    public function executeSavedocumentFonctionnaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $montant = $params['montant'];
            if ($id != "") {
                $id_explode = explode('_', $id);
                $salaire = new Salairedebase();
                $salaire->setIdCategorie($id_explode[0]);
                $salaire->setIdEchelle($id_explode[1]);
                $salaire->setIdEchelon($id_explode[2]);
                $salaire->setMotant($montant);
                $salaire->setDateouverture(date('Y-m-d'));
                $salaire->setDatefermeture(date('Y-m-d'));
                $salaire->setIdCorps(2);
                $salaire->save();
                die('ajout avec succe');
            }
        }
        die('erreur');
    }

    public function executeSavedocumentOuvirer(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            $montant = $params['montant'];


            if ($id != "") {
                $id_explode = explode('_', $id);

                $salaire = new Salairedebase();
                $salaire->setIdCategorie($id_explode[0]);
                $salaire->setIdGrade($id_explode[1]);
                $salaire->setIdEchelle($id_explode[2]);
                $salaire->setIdEchelon($id_explode[3]);
                $salaire->setMotant($montant);
                $salaire->setDateouverture(date('Y-m-d'));
                $salaire->setDatefermeture(date('Y-m-d'));
                $salaire->setIdCorps(1);
                $salaire->save();
                die('ajout avec succe');
            }
        }
        die('erreur');
    }

    public function executeEdit(sfWebRequest $request) {

//        $this->salairedebase = Doctrine_Core::getTable('salairedebase')->findAll();
//        $this->form = $this->configuration->getForm($this->salairedebase);
    }

//____________________Affichage salaire  
    public function executeListeSalaires(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $salaire = new Salairedebase();
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        $q = Doctrine_Query::create()
                ->select(" datefermeture,s.motant as motant, s.id_echelle as id_echelle, s.id_echelon as id_echelon, s.id_categorie as id_categorie ,s.id_grade as id_grade ")
                ->from('Salairedebase s')
                ->groupBy(' s.id, s.id_echelle, s.id_echelon , s.id_categorie , s.motant , s.datefermeture ')
                ->orderBy('s.datefermeture Asc') 
                
                
                ;
       
        $listessalaires = $q->fetchArray();

        die(json_encode($listessalaires));
    }

}
