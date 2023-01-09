<?php

require_once dirname(__FILE__) . '/../lib/profilGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/profilGeneratorHelper.class.php';

/**
 * profil actions.
 *
 * @package    Bmm
 * @subpackage profil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profilActions extends autoProfilActions {

    public function executeEnregistrer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $libelle = $request->getParameter('libelle');

        if ($id != '')
            $profil = ProfilTable::getInstance()->find($id);
        else
            $profil = new Profil ();

        $profil->setLibelle($libelle);
        $profil->save();

        die("OK");
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->profil = ProfilTable::getInstance()->find($id);
        $this->applications = $this->profil->getProfilapplication();
    }

    public function executeDeleteAffectation(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $user = UtilisateurTable::getInstance()->find($id);
        $user->setIdProfil(null);
        $user->save();
        die("OK");
    }

    public function executeEditModule(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
    }

    public function executeGetModule(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $ids = $request->getParameter('ids');

        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $this->applications = ApplicationTable::getInstance()->getByIds($ids);
        $this->profil = ProfilTable::getInstance()->find($id);
        
    }

    public function executeSaveProfil(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $app_ids = $request->getParameter('app_ids');
//        $module_ids = $request->getParameter('module_ids');
//        $action_ids = $request->getParameter('action_ids');
//
        $app_ids = substr($app_ids, 0, -1);
        $app_ids = explode(',', $app_ids);
//
//        $module_ids = substr($module_ids, 0, -1);
//        $module_ids = explode(';', $module_ids);
//
//        $action_ids = substr($action_ids, 0, -1);
//        $action_ids = explode('.', $action_ids);

        $profil = ProfilTable::getInstance()->find($id);

        //Delete old profile
        foreach ($profil->getProfilapplication() as $app) {
            foreach ($app->getProfilmodule() as $module) {
                foreach ($module->getProfilmoduleaction() as $action) {
                    $action->delete();
                }
                $module->delete();
            }
            $app->delete();
        }

        for ($i = 0; $i < sizeof($app_ids); $i++) {
            if ($app_ids[$i] != '') {
                $profil_application = new Profilapplication();
                $profil_application->setIdApplication($app_ids[$i]);
                $profil_application->setIdProfil($id);
                $profil_application->save();

//                $modules = $module_ids[$i];
//                $modules = substr($modules, 0, -1);
//                $modules = explode(',', $modules);
//
//                $actions = $action_ids[$i];
//                $actions = substr($actions, 0, -1);
//                $actions = explode(';', $actions);
//
//                for ($j = 0; $j < sizeof($modules); $j++) {
//                    if ($modules[$j] != '') {
//                        $profil_module = new Profilmodule();
//                        $profil_module->setIdApplicationmodule($modules[$j]);
//                        $profil_module->setIdProfilapplication($profil_application->getId());
//                        $profil_module->save();
//
//                        $id_actions = $actions[$j];
//                        $id_actions = substr($id_actions, 0, -1);
//                        $id_actions = explode(',', $id_actions);
//
//                        for ($k = 0; $k < sizeof($id_actions); $k++) {
//                            if ($id_actions[$k] != '') {
//                                $profil_action = new Profilmoduleaction();
//                                $profil_action->setLibelle($id_actions[$k]);
//                                $profil_action->setIdProfilmodule($profil_module->getId());
//                                $profil_action->save();
//                            }
//                        }
//                    }
//                }
            }
        }

        die("OK");
    }

    public function executeSaveProfilModuleAction(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $app_id = $request->getParameter('app_id');
        $modules = $request->getParameter('module_ids');
        $actions = $request->getParameter('action_ids');

        $modules = substr($modules, 0, -1);
        $modules = explode(',', $modules);

        $actions = substr($actions, 0, -1);
        $actions = explode(';', $actions);
        
        $profil_application = ProfilapplicationTable::getInstance()->findOneByIdProfilAndIdApplication($id, $app_id);

        for ($j = 0; $j < sizeof($modules); $j++) {
            if ($modules[$j] != '') {
                $profil_module = new Profilmodule();
                $profil_module->setIdApplicationmodule($modules[$j]);
                $profil_module->setIdProfilapplication($profil_application->getId());
                $profil_module->save();

                $id_actions = $actions[$j];
                $id_actions = substr($id_actions, 0, -1);
                $id_actions = explode(',', $id_actions);

                for ($k = 0; $k < sizeof($id_actions); $k++) {
                    if ($id_actions[$k] != '') {
                        $profil_action = new Profilmoduleaction();
                        $profil_action->setLibelle($id_actions[$k]);
                        $profil_action->setIdProfilmodule($profil_module->getId());
                        $profil_action->save();
                    }
                }
            }
        }
        
        die("OK");
    }

    public function executeImprimer(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF("L");
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Profil');
        $pdf->SetSubject("Fiche Profil");
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 7);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlFiche($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Profil' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $profil = new Profil();
        $html .= $profil->ReadHtmlFiche($id);

        return $html;
    }

}
