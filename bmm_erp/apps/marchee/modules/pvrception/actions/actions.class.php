<?php

require_once dirname(__FILE__) . '/../lib/pvrceptionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/pvrceptionGeneratorHelper.class.php';

/**
 * pvrception actions.
 *
 * @package    Bmm
 * @subpackage pvrception
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pvrceptionActions extends autoPvrceptionActions {

    public function executeNew(sfWebRequest $request) {
        $this->type = 'pro';
        if ($request->getParameter('type'))
            $this->type = $request->getParameter('type');
        $this->form = $this->configuration->getForm();
        $this->pvrception = $this->form->getObject();
        $this->pvrception->setTypepv($this->type);
        $this->id = $request->getParameter('id');
        //die($this->id . 'dsd'.$this->type);
    }

    public function executeEdit(sfWebRequest $request) {
//        $this->type = 'pro';
//        if ($request->getParameter('type'))
//            $this->type = $request->getParameter('type');
////        $this->form = $this->configuration->getForm();
////        $this->pvrception = $this->form->getObject();
////        $this->pvrception->setTypepv($this->type);
//        $this->id = $request->getParameter('id');
        $this->pvrception = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->pvrception);
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        if ($request->getParameter('type'))
            $type = $request->getParameter('type');
        $this->type = $type;
        if ($request->getParameter('id'))
            $id = $request->getParameter('id');
        $this->id = $id;
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    public function executeUploaderfile(sfWebRequest $request) {
        //             header('Access-Control-Allow-Origin: *');
//        $params = json_decode($request->getContent(),true);
//        $id = $params['id'];

        $id = $_REQUEST['id'];
        // $name = rand(1, 10005);
        // $name = rand(1, 10005) . $_FILES['fileSelected']['name'];
        if ($_FILES['fileSelected']['name'])
            $name = $_FILES['fileSelected']['name'];
        else
            $name = $_FILES['fileSelected']['name'];

        $uploads_dir = sfConfig::get('sf_upload') . $name;
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($name);
        $piece_joint->setIdPvreceptionmarche($id);
        $piece_joint->save();
        //  $this->redirect('pvrception/' . $id . '/edit');
        // return  $this->redirect('url',200);
        return $this->renderText(json_encode(array(
                    "valid" => 'upload success'
        )));
    }

    public function executeSavedocumentPvreception(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idvisiteur = '';
            $date = $params['date'];
            $observation = $params['observation'];
            $type = $params['type'];
            $id_lot = $params['id_lot'];
            if ($params['id'])
                $id = $params['id'];
            $ids = $params['id_dest'];
            $pvreception = new Pvrception();
            if ($id != "") {
                $pvreception = PvrceptionTable::getInstance()->findOneById($id);
            }
            for ($i = 0; $i < sizeof($ids); $i++) {
                if ($ids[$i] != '') {
                    if ($idvisiteur != '')
                        $idvisiteur = $idvisiteur . ';' . $ids[$i];
                    else
                        $idvisiteur = $ids[$i];
                }
            }
            if ($date != "") {
//                if ($type == "pro")
//                    $pvreception->setDatepvrecptionprovisoire($date);
//                if ($type == "def")
//                    $pvreception->setDatereceptiondef($date);
                $pvreception->setDatepvrecptionprovisoire($date);
            }
            if ($idvisiteur)
                $pvreception->setIdUser($idvisiteur);
            if ($type)
                $pvreception->setTypepv($type);
            if ($observation != "")
                $pvreception->setObservation($observation);
            if ($id_lot != "")
                $pvreception->setIdLots($id_lot);
            $pvreception->save();
            $lots = LotsTable::getInstance()->find($id_lot);
            if ($date)
                $lots->setDatereceptionprevesoire($date);

            $lots->save();

            $lots = LotsTable::getInstance()->find($id_lot);
            $marche = MarchesTable::getInstance()->findOneById($lots->getIdMarche());
            $delai_contratctuel = 0;
            if ($marche->getNbrelot() < 2)
                $delai_contratctuel = $marche->getDelai();
            else
                $delai_contratctuel.= $lots->getDelaicontractuelle();

            $stop_date = $lots->getDelaicontractuelle();
            $date_fin = strtotime($lots->getDateoservice() . '+' . $delai_contratctuel . 'day');
            $date_execution = $date_fin;
            if ($lots->getPeriodejustifier())
                $delai_execution = $delai_contratctuel + $lots->getPeriodejustifier();
            else
                $delai_execution = $delai_contratctuel;
            $delai_execution_reele = DifferenceDate::getJours($lots->getDateoservice(), $lots->getDatereceptionprevesoire());
            $diff_retard = $delai_execution_reele - $delai_execution;
            $penalte = floatval($diff_retard * $lots->getMarches()->getPenalite());
            $lots->setDatereceptionprevesoire($date);
            if ($delai_execution)
                $lots->setDelaidexucution($delai_execution);
            if ($delai_execution_reele)
                $lots->setPireodereelexecution($delai_execution_reele);
            if ($diff_retard)
                $lots->setPirioderetard($diff_retard);
            if ($diff_retard)
                $lots->setPirioderetard($diff_retard);
            if (!$lots->getDelaicontractuelle())
                $lots->setDelaicontractuelle($delai_contratctuel);
            $lots->save();
            die(json_encode($pvreception->getId()));
        }
        die("erreurr !!!");
    }

    public function executeShowPvReception(sfWebRequest $request) {
        $idpv = $request->getParameter('id');
        $this->pvrception = new pvrception();
        $this->pvrception = Doctrine_Core::getTable('pvrception')->findOneById($idpv);
        $this->form = new PvrceptionForm($this->pvrception);
        $type = $this->pvrception->getTypepv();
    }

    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche P.V Réception');
        $pdf->SetSubject("Fiche P.V Réception");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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
        $html = $this->ReadHtmlFicheDonneeBase($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche P.V Réception' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheDonneeBase($id) {
        $html = StyleCssHeader::header1();
        $agent = new Pvrception();
        $html .= $agent->ReadHtmlFichePvDonneeBase($id);

        return $html;
    }

    public function executeListepvreception(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];

            $query = "select pvrception.id , pvrception.datepvrecptionprovisoire as date, pvrception.typepv as type ,pvrception.observation as observation "
                    . " from pvrception,lots "
                    . " where  pvrception.id_lots=  " . $iddoc
                    . " and lots.id=pvrception.id_lots"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

}
