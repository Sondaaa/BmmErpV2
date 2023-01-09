<?php

require_once dirname(__FILE__) . '/../lib/alimentationcompteGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/alimentationcompteGeneratorHelper.class.php';

/**
 * alimentationcompte actions.
 *
 * @package    Bmm
 * @subpackage alimentationcompte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alimentationcompteActions extends autoAlimentationcompteActions {

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
        $this->sort = $this->getSort();
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('alimentationcompte');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $alimentationcompte = $form->save();

                //Mise à jour solde compte bancaire/CCP
                $caissesbanques = CaissesbanquesTable::getInstance()->find($alimentationcompte->getIdCompte());

                if ($caissesbanques->getMntdefini() != null) {
                    $new_solde = $caissesbanques->getMntdefini() + $alimentationcompte->getMontant();
                } else if ($caissesbanques->getMntouverture() != null) {
                    $new_solde = $caissesbanques->getMntouverture() + $alimentationcompte->getMontant();
                } else {
                    $new_solde = $alimentationcompte->getMontant();
                    $caissesbanques->setMntouverture($new_solde);
                }

                $caissesbanques->setMntdefini($new_solde);
                $caissesbanques->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $alimentationcompte)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@alimentationcompte_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'alimentationcompte_edit', 'sf_subject' => $alimentationcompte));
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

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->Andwhere("date >='" . date('Y') . "-01-01" . "'")
                ->Andwhere("date <='" . date('Y') . "-12-31" . "'")
                ->OrderBy('id desc');
        $query = $query->OrderBy('date desc');
        return $query;
    }

    public function executeSaveAlimentation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $piece_scan = $params['piece_scan'];
            $piece_jointe = $params['piece_jointe'];
            $date = $params['date'];
            $montant = $params['montant'];
            $compte_id = $params['compte_id'];
            $type = $params['type'];
            $libelle = $params['libelle'];

            $alimentationcompte = new Alimentationcompte();

            $alimentationcompte->setDate($date);
            $alimentationcompte->setMontant($montant);
            $alimentationcompte->setIdCompte($compte_id);
            if ($piece_jointe != '')
                $alimentationcompte->setChemin($piece_jointe);
            else
                $alimentationcompte->setChemin($piece_scan);

            $alimentationcompte->setType($type);
            $alimentationcompte->setLibellesource($libelle);

            //Cas d'alimentation
            if ($type == '0') {
                $source_id = $params['source_id'];
                $alimentationcompte->setIdSourcesbudget($source_id);
            }

            $alimentationcompte->save();

            if ($type == '0') {
                //Mise à jour solde compte bancaire/CCP
                $caissesbanques = CaissesbanquesTable::getInstance()->find($compte_id);
            } else {
                //Mise à jour solde compte bancaire/CCP cible
                $compte_id_to = $params['compte_id_to'];
                $caissesbanques = CaissesbanquesTable::getInstance()->find($compte_id_to);
            }

            if ($type == '0') {
                //Cas d'alimentation
                if ($caissesbanques->getMntdefini() != null) {
                    $new_solde = $caissesbanques->getMntdefini() + $montant;
                } else if ($caissesbanques->getMntouverture() != null) {
                    $new_solde = $caissesbanques->getMntouverture() + $montant;
                } else {
                    $new_solde = $montant;
                }
            } elseif ($type == '1') {
                //Cas du transfert
                if ($caissesbanques->getMntdefini() != null) {
                    $new_solde = $caissesbanques->getMntdefini() - $montant;
                } else {
                    $new_solde = $caissesbanques->getMntouverture() - $montant;
                }
            } else {
                //Cas du alimentation hors budget
            }

            $caissesbanques->setMntdefini($new_solde);
            $caissesbanques->save();


            //Cas du transfert
            if ($type == '1') {
                $compte_id_to = $params['compte_id_to'];
                $type_operation = $params['type_operation'];
                $instrument = $params['instrument'];
                $reference_ordonnance = $params['reference_ordonnance'];
                $reference_instrument = $params['reference_instrument'];
                $reference_cheque = $params['reference_cheque'];
                $cheque_id = $params['cheque_id'];

                //trouver le numéro suivant pour le mouvement du compte
                $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($compte_id);
                if ($mvt != null)
                    $numero = intval(intval($mvt->getNumero()) + 1);
                else
                    $numero = 1;

                $mouvement = new Mouvementbanciare();
                $mouvement->setNumero($numero);
                $mouvement->setNomoperation('Alimentation (Transfert de compte vers compte)');
                $mouvement->setReford($reference_ordonnance);
                $mouvement->setIdBanque($compte_id);
                $mouvement->setIdType($type_operation);
                $mouvement->setIdObject(4);
                $mouvement->setIdInstrument($instrument);
                if ($cheque_id != '')
                    $mouvement->setReferenceautre($reference_cheque);
                else
                    $mouvement->setReferenceautre($reference_instrument);
                $mouvement->setDebit($montant);

                $caisse_banque_to = CaissesbanquesTable::getInstance()->find($compte_id_to);

                if ($cheque_id) {
                    $mouvement->setIdCheque($cheque_id);
                    $cheque = PapierchequeTable::getInstance()->find($cheque_id);
                    //pour l'utiliser en cas : objet de règlement = transfert; dans le mouvement du compte cible
                    $cheque->setDatesignature($date);
                    $cheque->setMntcheque($montant);
                    $cheque->setCible(trim($caisse_banque_to->getLibelle()));
                    $cheque->setEtat(1);
                    $cheque->save();
                }
                $mouvement->setRefbenifi(trim($caisse_banque_to->getLibelle()));
                $mouvement->setRibbeni(trim($caisse_banque_to->getRib()));
                $mouvement->setDateoperation($date);
                $mouvement->setSolde($new_solde);
                $mouvement->setIdAlimentationcompte($alimentationcompte->getId());

                $mouvement->save();

                //
                //Ajout du mouvement lié au compte cible du transfert
                //
                
                $mouvement_cible = new Mouvementbanciare();
                //trouver le numéro suivant pour le mouvement du compte
                $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($compte_id_to);
                if ($mvt != null)
                    $numero_cible = intval(intval($mvt->getNumero()) + 1);
                else
                    $numero_cible = 1;
                $mouvement_cible->setNumero($numero_cible);
                $mouvement_cible->setNomoperation('Alimentation (Transfert de compte vers compte)');
                $mouvement_cible->setReford($reference_ordonnance);
                $mouvement_cible->setIdBanque($compte_id_to);
                $mouvement_cible->setIdType($type_operation);
                $mouvement_cible->setIdObject(4);
                $mouvement_cible->setIdInstrument($instrument);
                if ($cheque_id != '')
                    $mouvement_cible->setReferenceautre($reference_cheque);
                else
                    $mouvement_cible->setReferenceautre($reference_instrument);
                $mouvement_cible->setCredit($montant);

                //Calculer le nouveau solde du compte cible
                $banque_cible = CaissesbanquesTable::getInstance()->find($compte_id_to);
                if ($banque_cible->getMntdefini())
                    $solde_cible = $banque_cible->getMntdefini() + $montant;
                else
                    $solde_cible = $montant;

                //Set les paramètres du bénéficiaire (1èr compte est le bénéficiaire du 2ème compte et vice versa)
                $banque = CaissesbanquesTable::getInstance()->find($compte_id);
                $mouvement_cible->setRefbenifi($banque->getLibelle());
                $mouvement_cible->setRibbeni($banque->getRib());
                $mouvement_cible->setDateoperation($date);

                $mouvement_cible->setSolde($solde_cible);

                $mouvement_cible->setIdMouvement($mouvement->getId());
                $mouvement_cible->setIdAlimentationcompte($alimentationcompte->getId());
                $mouvement_cible->save();

                $banque_cible->setMntdefini($solde_cible);
                $banque_cible->save();
            }

            die("OK");
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $alimentationcompte = $this->getRoute()->getObject();
        $id_compte = $alimentationcompte->getIdCompte();
        $montant = $alimentationcompte->getMontant();

        if ($this->getRoute()->getObject()->delete()) {

            //Mise à jour solde compte bancaire/CCP
            $caissesbanques = CaissesbanquesTable::getInstance()->find($id_compte);
            $new_solde_defini = 0;
            $new_solde_ouverture = 0;
            if ($caissesbanques->getMntdefini() != $caissesbanques->getMntouverture()) {
                $new_solde_defini = $caissesbanques->getMntdefini() - $montant;
                $new_solde_ouverture = $caissesbanques->getMntouverture();
            } else {
                $new_solde_defini = $caissesbanques->getMntdefini() - $montant;
                $new_solde_ouverture = $new_solde_defini;
            }

            $caissesbanques->setMntdefini($new_solde_defini);
            $caissesbanques->setMntouverture($new_solde_ouverture);
            $caissesbanques->save();

            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@alimentationcompte');
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        // pdf object
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste Alimentations');
        $pdf->SetSubject("Liste Alimentations");
        $soc = SocieteTable::getInstance()->find(1);
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
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
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        $html = $this->ReadHtmlListe($request);
        // Print text using writeHTMLCell()
        // output the HTML content
//        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('Liste Alimentations.pdf', 'I');
        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListe(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $alimentation = new Alimentationcompte();
        $html .= $alimentation->ReadHtmlListe($request);

        return $html;
    }

    public function executeImprimer(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Alimentations');
        $pdf->SetSubject("Liste Alimentations");
        $soc = SocieteTable::getInstance()->find(1);
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');


        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(15, 30, 15);
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
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtml($id);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste Alimentations.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtml($id) {
        $html = StyleCssHeader::header1();
        $alimentation = new Alimentationcompte();
        $html .= $alimentation->ReadHtmlFiche($id);

        return $html;
    }

}
