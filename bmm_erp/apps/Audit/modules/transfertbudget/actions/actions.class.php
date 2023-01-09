<?php

require_once dirname(__FILE__) . '/../lib/transfertbudgetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/transfertbudgetGeneratorHelper.class.php';

/**
 * transfertbudget actions.
 *
 * @package    Bmm
 * @subpackage transfertbudget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transfertbudgetActions extends autoTransfertbudgetActions {

    public function executeValiderattachement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbudget'];
            $chaine = $params['chaine'];
            $piecejoint = new Piecejoint();
            $transfert = Doctrine_Core::getTable('transfertbudget')->findOneById($id); //die($id.'hh');
            if ($transfert) {
                $piecejoint->setIdTransfert($id);
                $piecejoint->setObjet("Budget:" . $titre);
            }

            $piecejoint->setIdTypepiece(7);

            $piecejoint->setChemin($chaine);
            $piecejoint->save();
            $this->CreateDossier($titre->getId() . '_' . $titre, $chaine);
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id")
                    ->from('piecejoint')
                    ->where('id_transfert=' . $id);

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function executeUploaderfile(sfWebRequest $request) {
        $id = $_REQUEST['idtransfert'];
        $titre = trim(str_replace(":", "", $_REQUEST['titre'])) . '_' . strtotime(date('Y-m-d H:m:s'));
        $name = explode(".", $_FILES['fileSelected']['name']);
        $nom = $titre;
        $uploads_dir = sfConfig::get('sf_upload') . $nom . '.' . $name[1];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($nom . '.' . $name[1]);
        $piece_joint->setIdTransfert($id);
        $piece_joint->save();
        die("Ajout avec succès");
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            //Dans le cas du modification : on annule les changements des montants
            if (!$form->getObject()->isNew()) {
                $transfertbudget = new Transfertbudget();
                $transfertbudget = $this->getRoute()->getObject();
                $mnt = $transfertbudget->getMnttransfert();
                if ($transfertbudget->getIdSource() != null) {
                    $ligne_bud_source = LigprotitrubTable::getInstance()->find($transfertbudget->getIdSource());
                    if ($ligne_bud_source) {
//                        $ligne_bud_source->setMnt($ligne_bud_source->getMnt() + $mnt);
                        $ligne_bud_source->setMntencaisse($ligne_bud_source->getMntencaisse() + $mnt);
                        $ligne_bud_source->save();
                    }
                }
                if ($transfertbudget->getIdDestination() != null) {
                    $ligne_bud_dest = LigprotitrubTable::getInstance()->find($transfertbudget->getIdDestination());
                    if ($ligne_bud_dest) {
                        $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() - $mnt);
//                        $ligne_bud_dest->setMnt($ligne_bud_dest->getMntencaisse() - $mnt);
                        $ligne_bud_dest->save();

                        /*                         * *************************** */
                        //Mise à jour du Rubrique Parent
                        $rubrique_destinateur = RubriqueTable::getInstance()->find($ligne_bud_dest->getIdRubrique());
                        if ($rubrique_destinateur->getIdRubrique() != null) {
                            $grand_ligne_dest = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_destinateur->getIdRubrique());
                            $grand_ligne_dest->setMntexterne($grand_ligne_dest->getMntexterne() - $mnt);
//                            $grand_ligne_dest->setMnt($grand_ligne_dest->getMntencaisse() - $mnt);
                            $grand_ligne_dest->save();
                        }
                        /*                         * **************************** */

                        //Ajout du montant externe (transfert) dans total externe  dans le titre budget
                        $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                        $titrebudget->setMntexterne($titrebudget->getMntexterne() - $mnt);
                        $titrebudget->save();
                    }
                }
            }
            //Fin changements des montants
            try {
                $transfertbudget = $form->save();
                $ligne_bud_source = new Ligprotitrub();
                $ligne_bud_dest = new Ligprotitrub();
                $mnt = $transfertbudget->getMnttransfert();
                if ($transfertbudget->getIdSource()) {
                    $source = Doctrine_Core::getTable('ligprotitrub')->findOneById($transfertbudget->getIdSource());
                    if ($source) {
                        $ligne_bud_source = $source;
//                        $ligne_bud_source->setMnt($ligne_bud_source->getMnt() - $mnt);
                        $ligne_bud_source->setMntencaisse($ligne_bud_source->getMntencaisse() - $mnt);
                        $ligne_bud_source->save();
                    }
                }
                $dest = Doctrine_Core::getTable('ligprotitrub')->findOneById($transfertbudget->getIdDestination());
                if ($dest) {
                    $ligne_bud_dest = $dest;
//                    $ligne_bud_dest->setMnt($ligne_bud_dest->getMnt() + $mnt);
                    $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() + $mnt);
//                    $ligne_bud_dest->setMnt($ligne_bud_dest->getMntencaisse() + $mnt);
                    $ligne_bud_dest->save();

                    /*                     * *************************** */
                    //Mise à jour du Rubrique Parent
                    $rubrique_destinateur = RubriqueTable::getInstance()->find($ligne_bud_dest->getIdRubrique());
                    if ($rubrique_destinateur->getIdRubrique() != null) {
                        $grand_ligne_dest = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_destinateur->getIdRubrique());
                        $grand_ligne_dest->setMntexterne($grand_ligne_dest->getMntexterne() + $mnt);
//                        $grand_ligne_dest->setMnt($grand_ligne_dest->getMntencaisse() + $mnt);
                        $grand_ligne_dest->save();
                    }
                    /*                     * **************************** */

                    //Ajout du montant externe (transfert) dans total externe dans le titre budget
                    $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                    $titrebudget->setMntexterne($titrebudget->getMntexterne() + $mnt);
                    $titrebudget->save();
                }
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $transfertbudget)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@transfertbudget_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'transfertbudget_edit', 'sf_subject' => $transfertbudget));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $transfertbudget = new Transfertbudget();
        $transfertbudget = $this->getRoute()->getObject();
        $mnt = $transfertbudget->getMnttransfert();
        if ($transfertbudget->getIdSource() != null) {
            $ligne_bud_source = LigprotitrubTable::getInstance()->find($transfertbudget->getIdSource());
            if ($ligne_bud_source) {
                $ligne_bud_source->setMnt($ligne_bud_source->getMnt() + $mnt);
                $ligne_bud_source->setMntencaisse($ligne_bud_source->getMntencaisse() + $mnt);
                $ligne_bud_source->save();
            }
        }
        if ($transfertbudget->getIdDestination() != null) {
            $ligne_bud_dest = LigprotitrubTable::getInstance()->find($transfertbudget->getIdDestination());
            if ($ligne_bud_dest) {
                $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() - $mnt);
                $ligne_bud_dest->setMntencaisse($ligne_bud_dest->getMntencaisse() - $mnt);
                $ligne_bud_dest->save();
                //Ajout du montant externe (transfert) dans total externe  dans le titre budget
                $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                $titrebudget->setMntexterne($titrebudget->getMntexterne() - $mnt);
                $titrebudget->save();
            }
        }

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@transfertbudget');
    }

    public function executeImprimerListe(sfWebRequest $request) {
        if ($request->getParameter('annee'))
            $annee = $request->getParameter('annee');
        else
            $annee = "";

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Transferts');
        $pdf->SetSubject("Liste Transferts");
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
        $html = $this->ReadHtmlListeTransfert($annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Transferts.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeTransfert($annee) {
        $html = StyleCssHeader::header1();
        $transfert_budget = new Transfertbudget();
        $html .= $transfert_budget->ReadHtmlListeTransfert($annee);
        return $html;
    }

    public function executeImprimer(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Transfert Budget');
        $pdf->SetSubject("Transfert Budget");
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
        $html = $this->ReadHtmlTransfert($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Transfert Budget.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlTransfert($id) {
        $html = StyleCssHeader::header1();
        $transfert_budget = new Transfertbudget();
        $html .= $transfert_budget->ReadHtmlTransfert($id);
        return $html;
    }

}
