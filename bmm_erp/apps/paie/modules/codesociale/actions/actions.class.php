<?php

require_once dirname(__FILE__) . '/../lib/codesocialeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/codesocialeGeneratorHelper.class.php';

/**
 * codesociale actions.
 *
 * @package    Bmm
 * @subpackage codesociale
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class codesocialeActions extends autoCodesocialeActions {

    //save 
    public function executeSavedocumentLigneCodesociale(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listedocCode = $params['listedocCode'];
            $id_codesociale = $params['id_codesociale'];
            if ($id_codesociale) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                Doctrine_Query::create()->delete('lignecodesociale')
                        ->where('id_codesoc=' . $id_codesociale)->execute();
            }
            foreach ($listedocCode as $lignedocCode) {
                $numero = $lignedocCode['norgdre'];
                $libelle = $lignedocCode['libelle'];
                $codesoc = $lignedocCode['codesociale'];
                $taux = $lignedocCode['taux'];
                $lignedocCode = new Lignecodesociale();
                if ($numero != "")
                    $lignedocCode->setNordre($numero);
                if ($id_codesociale != "")
                    $lignedocCode->setIdCodesoc($id_codesociale);

                if ($libelle != "")
                    $lignedocCode->setLibelle($libelle);
                if ($codesoc != "")
                    $lignedocCode->setCode($codesoc);
                if ($taux != "")
                    $lignedocCode->setTaux($taux);
                $lignedocCode->save();
            }
        }
        die('ajout avec succe');
    }

//affichage les lignes

    public function executeAfficheligneCodesociale(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_codesociale = $params['id'];

            $query = " select lignecodesociale.nordre as norgdre , lignecodesociale.libelle as libelle,"
                    . " lignecodesociale.code as codesociale  "
                    . ",concat(lignecodesociale.taux) as taux"
                    . " from codesociale ,lignecodesociale"
                    . " where lignecodesociale.id_codesoc=" . $id_codesociale . ""
                    . " and lignecodesociale.id_codesoc=codesociale.id"
                    . " group by lignecodesociale.nordre ,lignecodesociale.libelle , lignecodesociale.code ,lignecodesociale.taux";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

}
