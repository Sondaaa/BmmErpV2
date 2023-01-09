<?php

require_once dirname(__FILE__) . '/../lib/demandeurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandeurGeneratorHelper.class.php';

/**
 * demandeur actions.
 *
 * @package    symfony
 * @subpackage demandeur
 * @author     Your name here
 * @version    SVN: $Id$
 */
class demandeurActions extends autoDemandeurActions
{

    public function executeSaveDemandeur(sfWebRequest $request)
    {
        $user = $this->getUser()->getAttribute('userB2m');
        $choix = $request->getParameter('choix');
        $ids = $request->getParameter('ids');

        $ids = explode(',,', $ids);

        switch ($choix) {
            case 'zone_agent':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdAgent($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $agent = AgentsTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($agent->getNomcomplet());
                            $demandeur->setIdAgent($ids[$i]);
                            $demandeur->setIdUser($user->getId());
                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_service':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdService($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $service = ServicerhTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($service->getLibelle());
                            $demandeur->setIdService($ids[$i]);
                            $demandeur->setIdUser($user->getId());
                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_unite':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdUnite($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $unite = UniteTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($unite->getLibelle());
                            $demandeur->setIdUnite($ids[$i]);
                            $demandeur->setIdUser($user->getId());
                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_direction':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdDirection($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $direction = DirectionTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($direction->getLibelle());
                            $demandeur->setIdDirection($ids[$i]);
                            $demandeur->setIdUser($user->getId());
                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_sous_direction':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdSousdirection($ids[$i]);
                        if ($demandeu->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $sous_direction = SousdirectionTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($sous_direction->getLibelle());
                            $demandeur->setIdSousdirection($ids[$i]);
                            $demandeur->setIdUser($user->getId());
                            $demandeur->save();
                        }
                    }
                }
                break;

            default:
                break;
        }
    }

    //execute index
    public function executeIndex(sfWebRequest $request)
    {
        try {
            $this->pager = $this->paginate($request);
            $this->agents = AgentsTable::getInstance()->findAll();

            //getAgentsacontrat

            $this->demandeur = DemandeurTable::getInstance()->findAll();

            $id_agents = $request->getParameter('id_agents', '');

            if ($request->isXmlHttpRequest()) {

                return $this->renderPartial("listeDemandeur", array("pager" => $this->pager));
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function paginate(sfWebRequest $request)
    { $user = $this->getUser()->getAttribute('userB2m');
        $page = $request->getParameter('page', 1);
        $id_agents = $request->getParameter('id_agents', '');
        $libelle = $request->getParameter('libelle', '');
        $pager = new sfDoctrinePager('Demandeur', 10);
            $pager->setQuery(DemandeurTable::getInstance()->loadByLaboAdministration($id_agents, $libelle,$user->getId()));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeImprimerfichedemandeurLabo(sfWebRequest $request)
    {
        $id_demandeur = $request->getParameter('id');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche demandeur');
        $pdf->SetSubject("Fiche Demandeur");
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
        $logo=PDF_HEADER_LOGO.'/'.$societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete,$rs, '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $html = $this->ReadHtmlDemandeur($id_demandeur);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Demandeur.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDemandeur($id_demandeur)
    {
        $html = StyleCssHeader::header1();
        $piece = new Demandeur();
        $html .= $piece->ReadHtmldemandeurlabo($id_demandeur);
        return $html;
    }

    public function executeExporterDemandeurExcel(sfWebRequest $request)
    {
        $id_agents = $request->getParameter('id_agents', '');
        $libelle = $request->getParameter('libelle', '');
        $this->id_agents = $id_agents;
        $this->libelle = $libelle;
        $demandeur = DemandeurTable::getInstance()->load($id_agents, $libelle);
        $this->demandeur = $demandeur;
    }

    public function executeImprimerListeDemandeur(sfWebRequest $request)
    {

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Demandeurs');
        $pdf->SetSubject("Liste Des Demandeurs");
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
        $logo=PDF_HEADER_LOGO.'/'.$societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete,$rs, '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $html = $this->ReadHtmlListeDemandeur($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Des Agents.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemandeur(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $agents = new Demandeur();

        $html .= $agents->ReadHtmAlllListeDemandeurLabo($request);
        return $html;
    }

    public function executeDelete(sfWebRequest $request)
    {
        // die('id='.$request->getParameter('id'));    
        $demandeur = DemandeurTable::getInstance()->deleteQuery($request->getParameter('id'));
        $this->redirect('@demandeur');
    }
}
