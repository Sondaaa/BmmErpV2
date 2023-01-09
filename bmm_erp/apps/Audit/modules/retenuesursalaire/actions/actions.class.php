<?php

require_once dirname(__FILE__) . '/../lib/retenuesursalaireGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/retenuesursalaireGeneratorHelper.class.php';

/**
 * retenuesursalaire actions.
 *
 * @package    Bmm
 * @subpackage retenuesursalaire
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class retenuesursalaireActions extends autoRetenuesursalaireActions {

    public function executeAffichedetaildemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $ids = explode(',,', $ids);

            $query = " select retenuesursalaire.id as id, retenuesursalaire.montantpret as montanttotal"
                    . " ,retenuesursalaire.retenuesursalaire as montantmensielle "
                    . " ,retenuesursalaire.mois as mois,"
                    . "retenuesursalaire.datedebut as demandeavance"
                    . ",retenuesursalaire.datefin as datefinretenue, "
                    . " retenuesursalaire.annee as annee"
                    . ",concat(agents.nomcomplet , agents.prenom) as agents "
                    . " ,retenuesursalaire.nbrmois as nbrmois"
                    . ",fournisseur.rs as typeavance"
                    . " from retenuesursalaire,pret ,agents ,fournisseur"
                    . "  where  retenuesursalaire.id_agents IN (" . implode(',', array_map('intval', $ids)) . ")"
                    . "  and retenuesursalaire.id_agents = agents.id"
                    . " and retenuesursalaire.id_fournisseur = fournisseur.id"
                    . " and TO_CHAR(retenuesursalaire.datefin, 'yyyy-mm') >= '" . date("Y-m") . "'"
                    . " and TO_CHAR(retenuesursalaire.datedebut, 'yyyy-mm') <= '" . date("Y-m") . "'"
                    . " and  (retenuesursalaire.paye = false or retenuesursalaire.paye is NULL)"
                    . " Group By retenuesursalaire.id ,agents.nomcomplet ,agents.prenom,fournisseur.rs"

            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    //afffiche detail agents 
    public function executeAfficehdetailAgentsPourRetenue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['id_agents'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as idrh ,agents.nomcomplet as nom ,agents.prenom as prenom,"
                    . " agents.mail as mail, agents.codepostal as codepostal, agents.adresse as adresse"
                    . " FROM agents"
                    . " where agents.id=" . $idagent
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //affiche liste des fournisseur 
    public function executeAfficeListeFournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $naturepret = $params['naturepret'];
            $query = " select fournisseur.id as id ,fournisseur.rs as libelle "
                    . " from fournisseur "

            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//impression 

    public function executeImprimerListeRetenueSurSalaire(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Retenues Sur Salaire');
        $pdf->SetSubject("Liste Des Retenues Sur Salaire");
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
        $html = $this->ReadHtmlListeRetenuesursalaire($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Retenues Sur Salaire.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeRetenuesursalaire(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $demande = new Retenuesursalaire();
        $html .= $demande->ReadHtmlListeRetenuesursalaire($request);
        return $html;
    }

}
