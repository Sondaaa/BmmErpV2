<?php

require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorHelper.class.php';

/**
 * fournisseur actions.
 *
 * @package    Bmm
 * @subpackage fournisseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fournisseurActions extends autoFournisseurActions {

    //______________________________________________________________________Ajouter fournisseur
    public function executeAjoutfournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "" || $ref != "") {
                $fournisseur = new Fournisseur();
                $q = Doctrine_Query::create()
                        ->select("*")
                        ->from('fournisseur');
                if ($frs != "")
                    $q = $q->where("rs like '%" . $frs . "%'");
                if ($ref != "")
                    $q = $q->where("reference like '%" . $ref . "%'");
                if ($frs != "" && $ref != "")
                    $q = $q->where("rs like '%" . $frs . "%'")
                            ->Orwhere("reference like '%" . $ref . "%'");

                $frss = $q->execute();

                if (count($frss) > 0)
                    $fournisseur = $frss[0];

                $fournisseur->setRs($frs);
                $fournisseur->setReference($ref);
                $fournisseur->save();
                if (!$frss)
                    die('Succès d\'ajout');
                else
                    die('Mise à jour fiche fournisseur');
            }
        }
        die('Erreur d\'ajout');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        // $fournisseur = new Fournisseur();
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            try {
                $assujtva = $request->getParameter('assujtva');
                if ($assujtva == 'on') {
                    $assujtva = 1;
                } else {
                    $assujtva = 0;
                }
                if ($assujtva)
                    $fournisseur->setAssujtva($assujtva);
                $fodec = $request->getParameter('fodec');
                if ($fodec == 'on') {

                    $fodec = 1;
                } else {
                    $fodec = 0;
                }

                if ($fodec)
                    $fournisseur->setFodec($fodec);
                $fournisseur = $form->save();
                $fournisseur->setUpdatedAt(date('Y-m-d'));
                $fournisseur->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $fournisseur)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@fournisseur_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'fournisseur_edit', 'sf_subject' => $fournisseur));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());
        $query = $query;
        if (isset($filter['codefrs']) && !empty($filter['codefrs']['text']))
            $query = $query->where("codefrs like '%" . $filter['codefrs']['text'] . "%'");

        if (isset($filter['matriculefiscale']) && !empty($filter['matriculefiscale']['text']))
            $query = $query->where("UPPER(matriculefiscale) like '%" . strtoupper($filter['matriculefiscale']['text']) . "%'");
        if (isset($filter['rs']) && !empty($filter['rs']['text']))
            $query = $query->where("UPPER(rs) like '%" . strtoupper($filter['rs']['text']) . "%'");
        if (isset($filter['tel']) && $filter['tel']['text'] != "") {
            $query = $query->Andwhere('tel=' . $filter['tel']['text']);
        }
        if (isset($filter['mail']) && $filter['mail']['text'] != "") {
            $query = $query->Andwhere('mail=' . $filter['mail']['text']);
        }
        if (isset($filter['id_activite']) && $filter['id_activite'][0] != "") {
            $query = $query->Andwhere('id_activite=' . $filter['id_activite'][0]);
        }

        $this->addSortQuery($query);
//           die($query);
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    protected function getFilters() {
        return $this->getUser()->getAttribute('fournisseur.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }

    public function executeImprimerListeFounisseur(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Fournisseurs');
        $pdf->SetSubject("Liste Des Fournisseurs");
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
        $html = $this->ReadHtmlListeFournisseur($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Des Fournisseurs.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeFournisseur(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $frounisseur = new Fournisseur();

        $html .= $frounisseur->ReadHtmAlllListeFounisseur($request);
        return $html;
    }

    public function executeExporterFourniseseurExcel(sfWebRequest $request) {
        $id_activite = $request->getParameter('id_activite', '');
        $matricule_fiscale = $request->getParameter('matricule', '');
        $tel = $request->getParameter('tel', '');
        $mail = $request->getParameter('mail', '');

        $rs = $request->getParameter('rs');
        $codefrs = $request->getParameter('codefrs');

        $this->codefrs = $codefrs;
        $this->id_activite = $id_activite;
        $this->rs = $rs;
        $this->matricule_fiscale = $matricule_fiscale;
        $this->tel = $tel;
        $this->mail = $mail;
        $forunisseur = FournisseurTable::getInstance()->getActif($codefrs, $rs, $id_activite, $matricule_fiscale,$tel,$mail);
        $this->fournisseurs = $forunisseur;
    }
      public function executeImprimerficheFournisseur(sfWebRequest $request) {
        $id_forunisseur = $request->getParameter('idfrs');
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Fournisseur');
        $pdf->SetSubject("Fiche Fournisseur");
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
        $html = $this->ReadHtmlFournisseur($id_forunisseur);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Fournisseur.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFournisseur($id_forunisseur) {
        $html = StyleCssHeader::header1();
        $piece = new Fournisseur();
        $html .= $piece->ReadHtmlFournisseur($id_forunisseur);
        return $html;
    }

}
