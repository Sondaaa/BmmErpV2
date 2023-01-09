<?php

require_once dirname(__FILE__) . '/../lib/contribitionpatronaleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contribitionpatronaleGeneratorHelper.class.php';

/**
 * contribitionpatronale actions.
 *
 * @package    Bmm
 * @subpackage contribitionpatronale
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribitionpatronaleActions extends autoContribitionpatronaleActions {

    //save 
    public function executeSavedocumentLigneContibition(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listedocContribition = $params['listedocContribition'];
            $id_contribiton = $params['id_contribiton'];
            if ($id_contribiton) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                Doctrine_Query::create()->delete('lignecontribitionsociale')
                        ->where('id_contribition=' . $id_contribiton)->execute();
            }
            foreach ($listedocContribition as $lignedocContribtion) {
                $numero = $lignedocContribtion['norgdre'];
                $libelle = $lignedocContribtion['libelle'];
                $code = $lignedocContribtion['contribition'];
                $taux = $lignedocContribtion['taux'];
                $lignedocContribtion = new Lignecontribitionsociale();
                if ($numero != "")
                    $lignedocContribtion->setNordre($numero);
                if ($id_contribiton != "")
                    $lignedocContribtion->setIdContribition($id_contribiton);

                if ($libelle != "")
                    $lignedocContribtion->setLibelle($libelle);
                if ($code != "")
                    $lignedocContribtion->setCode($code);
                if ($taux != "")
                    $lignedocContribtion->setTaux($taux);
                $lignedocContribtion->save();
            }
        }
        die('ajout avec succe');
    }

//affichage les lignes

    public function executeAfficheligneContribition(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_contribtion = $params['id'];

            $query = " select lignecontribitionsociale.nordre as norgdre ,"
                    . " lignecontribitionsociale.libelle as libelle,"
                    . " lignecontribitionsociale.code as contribition  "
                    . ",concat(lignecontribitionsociale.taux) as taux"
                    . " from contribitionpatronale ,lignecontribitionsociale"
                    . " where lignecontribitionsociale.id_contribition=" . $id_contribtion . ""
                    . " and lignecontribitionsociale.id_contribition=contribitionpatronale.id"
                    . " group by lignecontribitionsociale.nordre ,lignecontribitionsociale.libelle , lignecontribitionsociale.code ,lignecontribitionsociale.taux";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

}
