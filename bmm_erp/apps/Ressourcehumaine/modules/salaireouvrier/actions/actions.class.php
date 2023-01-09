<?php

require_once dirname(__FILE__) . '/../lib/salaireouvrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/salaireouvrierGeneratorHelper.class.php';

/**
 * salaireouvrier actions.
 *
 * @package    Bmm
 * @subpackage salaireouvrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class salaireouvrierActions extends autoSalaireouvrierActions {

    public function executeAffichedetailOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Ouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT contratouvrier.id_ouvrier as idouv"
                    . " ,contratouvrier.id_specialteouvrier as idsp,specialiteouvrier.libelle as situation"
                    . " , contratouvrier.id_chantier as idch ,"
                    . " chantier.libelle as chantier "
                    . " , contratouvrier.montant as montantjour "
                    . " , contratouvrier.datefincontrat as df"
                    . " ,  contratouvrier.datedebutcontrat as dd"
                    . " FROM contratouvrier , chantier , specialiteouvrier"
                    . " WHERE contratouvrier.id_chantier=chantier.id"
                    . " and contratouvrier.id_specialteouvrier= specialiteouvrier.id"
                    . " and  contratouvrier.id=" . $idagent;



            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affichage historique 


    public function executeAffichedetailHistoriqueOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['idag'];   
            $date_debut = $params['date_debut'];  
            $date_fin = $params['date_fin'];       
            $query = "select historiquecontratouvrier.id as id,"
                    . " historiquecontratouvrier.daterecrutement as datere ,"
                    . " historiquecontratouvrier.datedebutcontrat as dated ,"
                    . " historiquecontratouvrier.datefoncontrat as datef, "
                    . " historiquecontratouvrier.id_lieu as idlieu , "
                    . " lieuaffectationouvrier.libelle as lieu ,"
                    . " historiquecontratouvrier.montant as montant,"                                
                    . " historiquecontratouvrier.id_specialite as idsp, "
                    . " specialiteouvrier.libelle as specialite,"
                    . " historiquecontratouvrier.id_situtaion as  idsit ,"
                    . " situationadminouvrier.libelle as situation,"
                    . " historiquecontratouvrier.id_chantier as idchantier ,"
                    . " chantier.libelle as chantier ,"
                    . " historiquecontratouvrier.nbjour as nbrj "
                    . ", historiquecontratouvrier.montanttotal as montantotal" 
                    . " from historiquecontratouvrier , lieuaffectationouvrier,"
                    . " specialiteouvrier,chantier,situationadminouvrier"
                    . " where historiquecontratouvrier.id_contratouvrier=" . $id_Contrat . ""
                    . " and historiquecontratouvrier.id_lieu=lieuaffectationouvrier.id "
                    . " and historiquecontratouvrier.id_situtaion= situationadminouvrier.id"
                    . " and historiquecontratouvrier.id_specialite=specialiteouvrier.id"
                    . " and historiquecontratouvrier.id_chantier=chantier.id"
                    . " and historiquecontratouvrier.datedebutcontrat >= ' "  .$date_debut ."' "
                    . " and  historiquecontratouvrier.datefoncontrat <= '" . $date_fin ."'"
                   ;
               //    die($query);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesH = $conn->fetchAssoc($query);
            die(json_encode($listesH));
        }
        die("bien");
    }

}
