<?php

require_once dirname(__FILE__) . '/../lib/societeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/societeGeneratorHelper.class.php';

/**
 * societe actions.
 *
 * @package    Bmm
 * @subpackage societe
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class societeActions extends autoSocieteActions {

    //save document lignemois 

    public function executeSavedocumentLigneMois(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listedocMois = $params['listedocMois'];
            $id_societe = $params['id_societe'];
            $annee = $params['annee'];
            $nbrmois = $params['nbrmois'];
            if ($id_societe) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('lignesociete')
                        ->where('id_societe=' . $id_societe)
                        ->andWhere('annee=' . $annee)->execute();
            }
            foreach ($listedocMois as $lignedocMois) {
                $numero = $lignedocMois['norgdre'];
                $libelle = $lignedocMois['libelle'];
                $codemois = $lignedocMois['codemois'];
                $mois_calendrial = $lignedocMois['idmois'];
                $lignedocSociete = new Lignesociete();
                if ($numero != "")
                    $lignedocSociete->setNordre($numero);
                if ($id_societe != "")
                    $lignedocSociete->setIdSociete($id_societe);

                if ($libelle != "")
                    $lignedocSociete->setLibelle($libelle);
                if ($codemois != "")
                    $lignedocSociete->setCodemois($codemois);
                if ($mois_calendrial != "")
                    $lignedocSociete->setMoiscalendiarle($mois_calendrial);
                if ($nbrmois != "")
                    $lignedocSociete->setNbrmois($nbrmois);
                if ($annee != "")
                    $lignedocSociete->setAnnee($annee);
                $lignedocSociete->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeAfficheligneSociete(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_societe = $params['id'];
            $annee = $params['annee'];
//            $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre")

            $query = " select lignesociete.nordre as norgdre , lignesociete.libelle as libelle,"
                    . " lignesociete.codemois as codemois  "
                    . ",lignesociete.moiscalendiarle as idmois"
                    . " ,TO_CHAR(TO_DATE(CONCAT('2019-',LPAD(lignesociete.moiscalendiarle::TEXT,2,'0'), '-01'), 'YYYY-MM-DD'),'TMMonth') as mois_calendrial"
                    . " from societe ,lignesociete"
                    . " where lignesociete.id_societe=" . $id_societe . ""
                    . " and lignesociete.annee=" . $annee
                    . " and lignesociete.id_societe=societe.id"
                    . " group by lignesociete.nordre ,lignesociete.libelle , lignesociete.codemois ,lignesociete.moiscalendiarle";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

//ligne societe 

    public function executeAfficheListeLignesociete(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $annee = $params['annee'];
            $query = " select lignesociete.nordre as norgdre , lignesociete.libelle as libelle,"
                    . " lignesociete.codemois as codemois  "
                    . ",lignesociete.moiscalendiarle as idmois"
                    . " ,TO_CHAR(TO_DATE(CONCAT('2019-',LPAD(lignesociete.moiscalendiarle::TEXT,2,'0'), '-01'), 'YYYY-MM-DD'),'TMMonth') as mois_calendrial"
                    . " from societe ,lignesociete"
                    . " where  lignesociete.annee=" . $annee
                    . " and lignesociete.id_societe=societe.id"
                    . " group by lignesociete.nordre ,lignesociete.libelle , lignesociete.codemois ,lignesociete.moiscalendiarle";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

}
