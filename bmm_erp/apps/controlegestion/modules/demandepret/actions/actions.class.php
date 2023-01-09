<?php

require_once dirname(__FILE__) . '/../lib/demandepretGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandepretGeneratorHelper.class.php';

/**
 * demandepret actions.
 *
 * @package    Bmm
 * @subpackage demandepret
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandepretActions extends autoDemandepretActions {

    public function executeAffichedetaildemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $ids = explode(',,', $ids);

            $query = " select demandepret.id as id , demandepret.montantpret as montanttotal"
                    . " , demandepret.montantmentielle as montantmensielle "
                    . " ,demandepret.mois as mois,"
                    . "demandepret.datedebutretenue as demandeavance"
                    . ",demandepret.datefinretenue as datefinretenue, "
                    . " demandepret.annee as annee,concat(agents.nomcomplet , agents.prenom) as agents, "
                    . " pret.libelle as typeavance,demandepret.nbrmois as nbrmois"
                    . " from demandepret,pret ,agents"
                    . " where  demandepret.id_agents IN (" . implode(',', array_map('intval', $ids)) . ")"
                    . "  and demandepret.id_agents = agents.id"
                    . " and demandepret.id_typepret = pret.id"
                    . " and TO_CHAR(demandepret.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                    . " and TO_CHAR(demandepret.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                    . " and  (demandepret.paye = false or demandepret.paye is NULL)"
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeAfficeTypePret(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $source = $params['source'];
            $query = " select  pret.id as id, pret.libelle as libelle"
                    . " from pret "
                    . " where  pret.id_source= " . $source
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//affiche detail agents 

    public function executeAfficehdetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['id_agents'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as idrh ,agents.nomcomplet as nom ,agents.prenom as prenom,"
                    . " agents.mail as mail, agents.codepostal as codepostal, agents.adresse as adresse,"
                    . " contrat.id_agents as idag,contrat.id as idcontrat ,contrat.datetitulaire as datetitulaire"
                    . ",contrat.id_salairedebase as idsal "
                    . ",salairedebase.id_grade as idgrade ,salairedebase.motant as salaire"
                    . ",grade.libelle as grade , categorierh.libelle as categorie,"
                    . " contrat.dateemposte as dateemposte, typecontrat.libelle as situation"
                    . " , contrat.id_posterh as idposte , posterh.id as idp"
                    . " ,posterh.libelle as poste"
                    . " ,posterh.id_unite as idunite,unite.id as id_unite , unite.libelle as unite "
                    . " ,unite.id_service as idservice, servicerh.libelle as service "
                    . " , servicerh.id_sousdirection as idsousdirection , sousdirection.libelle as sousdirection"
                    . " , sousdirection.id_direction as iddirection , direction.libelle as direction"
                    . " FROM agents , contrat , posterh ,unite,servicerh,sousdirection,direction ,"
                    . " grade,salairedebase,categorierh,typecontrat"
                    . " WHERE contrat.id_agents=agents.id "
                    . " and contrat.id_posterh=posterh.id"
                    . " and posterh.id_unite=unite.id"
                    . " and unite.id_service=servicerh.id"
                    . " and contrat.id_salairedebase=salairedebase.id "
                    . " and contrat.id_typecontrat=typecontrat.id "
                    . " and salairedebase.id_grade=grade.id"
                    . " and salairedebase.id_categorie=categorierh.id"
                    . " and servicerh.id_sousdirection=sousdirection.id"
                    . " and sousdirection.id_direction=direction.id"
                    . " and agents.id=" . $idagent
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affiche info soc 

    public function executeAfficeInfoSoc(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $query = " select  societe.id as id, societe.rs as rs ,societe.matfiscal as matfiscal"
                    . " from societe "
                    . " where  societe.id= " . $id
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    //affiche liste primes
    public function executeAffichelignePrimes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select primes.id as idprime,ligneprimecontrat.nordre as norgdre ,"
                    . " primes.id_titreprime as nordre"
                    . ", titreprimes.libelle as libelle ,primes.montant as montant "
                    . " from ligneprimecontrat,primes,titreprimes"
                    . " where ligneprimecontrat.id_contrat=" . $id_Contrat . ""
                    . " and ligneprimecontrat.id_prime=primes.id "
                    . " and titreprimes.id=primes.id_titreprime";
            // . " order by ligneprimecontrat.id asc";


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsPrime = $conn->fetchAssoc($query);
            die(json_encode($listedocsPrime));
        }
        die("bien");
    }

    //affiche liste pret 


    public function executeAffichelignePret(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = "select demandepret.id as id,"
                    . "demandepret.id_typepret as idtype ,"
                    . "pret.libelle as naturepret , "
                    . "pret.id_source as idsource"
                    . " ,sourcepret.libelle as sourcepret,"
                    . " demandepret.montantmentielle as montantmensielle"
                    . ", demandepret.datefinretenue as datefinretenue"
                    . " from demandepret,pret,sourcepret"
                    . " where demandepret.id_agents=" . $id_agents
                    . " and demandepret.id_typepret=pret.id "
                    . " and demandepret.paye=FALSE "
                    . " and demandepret.datefinretenue >= '" . date('Y-m-d') . "'"
                    . " and pret.id_source=sourcepret.id";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsPret = $conn->fetchAssoc($query);
            die(json_encode($listedocsPret));
        }
        die("bien");
    }

    //delete 
    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $this->forward404Unless($demandepret = Doctrine_Core::getTable('demandepret')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $demandepret->delete();
        $this->redirect('@demandepret');
    }

    //impresion des demandes

    public function executeImprimerDemande(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('iddoc');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche de Demande de pret:');
        $pdf->SetSubject("document du liste de demandes des prets ");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeDemandePret($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemandePret($id) {
        $html = StyleCssHeader::header1();
        $documents = new Demandepret();

        $html .= $documents->ReadHtmlListeDemandeDePret($id);
        return $html;
    }

    public function executeEdit(sfWebRequest $request) {

        $this->demandepret = Doctrine_Core::getTable('demandepret')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->demandepret);
    }

//impression liste des retenue 
    public function executeImprimerListeRetenue(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Retenues Pret');
        $pdf->SetSubject("Liste Des Retenues Pret");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
         $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeRetenue($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Retenues pret.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeRetenue(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $demande = new Demandepret();
        $html .= $demande->ReadHtmlListeRetenue($request);
        return $html;
    }

    public function executeRetenuesursalaire(sfWebRequest $request) {
        
    }

}
