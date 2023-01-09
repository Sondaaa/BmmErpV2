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

    public function executeIndexFrsActif(sfWebRequest $request) {
        $this->familles = FamillearticleTable::getInstance()->findAll();
        $this->activites = ActivitetiersTable::getInstance()->findAll();
        $this->actif = $request->getParameter('actif');
        $this->pager = $this->paginate($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeFournisseur", array("pager" => $this->pager, "actif" => $this->actif));
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->fournisseur = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->fournisseur);
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page');

        $id_activite = $request->getParameter('id_activite');
        $rs = $request->getParameter('rs');
        $id_famille = $request->getParameter('id_famille');
        $codefrs = $request->getParameter('codefrs');
        $actif = 'Actif';

        $pager = new sfDoctrinePager('fournisseur', 10);
        $pager->setQuery(FournisseurTable::getInstance()->getActif($codefrs, $rs, $id_activite, $id_famille));
        $pager->setPage($page);
        $pager->init();

        return $pager;
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
        $this->pager = $this->getPager();
        //    $this->pager = $this->paginate($request);
        $this->sort = $this->getSort();
        $this->actif = 'Actif';
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('fournisseur');
        //     $pager->setQuery(FournisseurTable::getInstance()->getActf());

        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
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
            $query = $query->where("codefrs = '%" . $filter['codefrs']['text'] . "%'");
        if (isset($filter['rs']) && !empty($filter['rs']['text']))
            $query = $query->where("UPPER(rs) like '%" . strtoupper($filter['rs']['text']) . "%'");
        if (isset($filter['id_famillearticle']) && $filter['id_famillearticle'][0] != "") {
            $query = $query->Andwhere('id_famillearticle=' . $filter['id_famillearticle'][0]);
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
                //die($q);
                $frss = $q->execute();

                if (count($frss) > 0)
                    $fournisseur = $frss[0];
                //  die(count($frss).'---'.$q);
                $fournisseur->setRs($frs);
                $fournisseur->setReference($ref);
                $fournisseur->setEtatfrs('Actif');
                $fournisseur->save();
                if (!$frss)
                    die('Succès d\'ajout');
                else
                    die('Mise à jour fiche fournisseur');
            }
        }
        die('Erreur d\'ajout');
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
        $id_famille = $request->getParameter('id_famille', '');
        $rs = $request->getParameter('rs');
        $codefrs = $request->getParameter('codefrs');

        $this->codefrs = $codefrs;
        $this->id_famille = $id_famille;
        $this->rs = $rs;
        $this->id_famille = $id_famille;
        $forunisseur = FournisseurTable::getInstance()->getActif($codefrs, $rs, $id_activite, $id_famille);
        $this->fournisseurs = $forunisseur;
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
//        $fournisseur = new Fournisseur();
//        $fournisseur->setEtatfrs('Actif');
//        $fournisseur = $form->save();
        $form->getObject()->setEtatfrs('Actif');
        $form->save();
        if ($form->isValid()) {
          //   $frs = $form->save();
             
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            try {
               
                // $assujtva = $request->getParameter('assujtva');die($assujtva);
                // if ($assujtva == 'on') {
                //     die($assujtva . "on");
                //     $assujtva = 1;
                // } else {
                //     $assujtva = 0;
                //     die($assujtva . "of");
                // }
                // die($assujtva . "ofbb");
                // $fournisseur->setAssujtva($assujtva);
//                $fournisseur = FournisseurTable::getInstance()->find($frs->getId());
//
//                $fournisseur->setEtatfrs('Actif');
//                $fournisseur = $form->save();
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

}
