<?php



require_once dirname(__FILE__) . '/../lib/marchesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/marchesGeneratorHelper.class.php';

/**
 * marches actions.
 *
 * @package    Bmm
 * @subpackage marches
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class marchesActions extends autoMarchesActions {

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->marches = $this->form->getObject();
        $this->marches->setNumero($this->marches->NumeroSeqMarches());
    }
   
    public function executeAffichesource(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];
            if ($table == "sourcesbudget") {
                $sourcesFinanacement = Doctrine_Query::create()
                                ->select("sourcesbudget.id , sourcesbudget.source as libelle")
                                ->from('sourcesbudget')->fetchArray();
                die(json_encode($sourcesFinanacement));
            }
            if ($table == "titrebudjet") {
                //
                $id = $params['id']; //die('ss'.$id);
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT    titrebudjet.libelle,   titrebudjet.id "
                            . "FROM   ligprotitrub,   sourcesbudget,   titrebudjet"
                            . " WHERE   titrebudjet.id_source = sourcesbudget.id AND   "
                            . "ligprotitrub.id_titre = titrebudjet.id and sourcesbudget.id=" . $id . " "
                            . "group by titrebudjet.libelle,   titrebudjet.id";
                    //die($query);
                    $titresBudget = $conn->fetchAssoc($query);


                    die(json_encode($titresBudget));
                }
            }
            if ($table == "rubrique") {
                //
                $id = $params['id']; //die('ss'.$id);
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT    rubrique.id,    rubrique.libelle "
                            . "FROM    ligprotitrub,    titrebudjet,    rubrique "
                            . "WHERE    ligprotitrub.id_titre = titrebudjet.id "
                            . "AND   ligprotitrub.id_rubrique = rubrique.id "
                            . "and rubrique.id_rubrique is null and titrebudjet.id= " . $id
                            . " group by rubrique.id,    rubrique.libelle;";
                    //die($query);
                    $titresBudget = $conn->fetchAssoc($query);


                    die(json_encode($titresBudget));
                }
            }
            if ($table == "sousrubrique") {
                //
                $id = $params['id']; //die('ss'.$id);
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT    rubrique.id,   rubrique.libelle "
                            . "FROM    ligprotitrub,   rubrique "
                            . "WHERE   ligprotitrub.id_rubrique = rubrique.id "
                            . "and rubrique.id_rubrique is not null and rubrique.id_rubrique= " . $id
                            . " group  by  rubrique.id,   rubrique.libelle;";
                    //die($query);
                    $titresBudget = $conn->fetchAssoc($query);


                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $marches = $form->save();
                $marches->ChangerEtatDocAchat();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $marches)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@marches_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'marches_edit', 'sf_subject' => $marches));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
    public function executeEdit(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $marches = MarchesTable::getInstance()->find($id);
        $this->marches = $marches;
        $this->form = $this->configuration->getForm($this->marches);
        
    }
    public function executeImprimerMarches(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF('');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('March??s');
        $pdf->SetSubject("March??s");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'T??l:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');



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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlMarches($id);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('March??s.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMarches($id) {
        $html = StyleCssHeader::header1();
        $marches = new Marches();
        $html .= $marches->ReadHtmlMarches($id,  $this->getUser()->getAttribute('userB2m'));

        return $html;
    }
    public function executeUploaderfile(sfWebRequest $request)
    {
        //header('Access-Control-Allow-Origin: *');
        $id = $_REQUEST['id'];
        $name = $_FILES['fileSelected']['name'];
        $uploads_dir = sfConfig::get('sf_upload') . $name;
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($name);
        $piece_joint->setIdMarche($id);
        $piece_joint->save();
        // $this->redirect('Achatdoc/showdocument?iddoc=' . $id . '&idtab=1');
        // return  $this->redirect('url',200);
        return $this->renderText(json_encode(array(
            "valid" => 'upload success',
        )));
    }

}
