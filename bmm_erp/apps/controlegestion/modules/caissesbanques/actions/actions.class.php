<?php

require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorHelper.class.php';

/**
 * caissesbanques actions.
 *
 * @package    Bmm
 * @subpackage caissesbanques
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class caissesbanquesActions extends autoCaissesbanquesActions {

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $caissesbanques = $form->save();
                $banque = new Caissesbanques();
                $banque = $caissesbanques;
                $banque->setIdTypecb(1);
                $banque->setMntprov($banque->getMntouverture());
                $banque->setMntdefini($banque->getMntouverture());
                $banque->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $caissesbanques)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@caissesbanques_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'caissesbanques_edit', 'sf_subject' => $caissesbanques));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
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
        $this->sort = $this->getSort();
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@caissesbanques');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@caissesbanques');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    public function executeNew(sfWebRequest $request) {
        $this->idtype = 1;
        $this->form = $this->configuration->getForm();
        $this->caissesbanques = $this->form->getObject();
    }

    public function executeEdit(sfWebRequest $request) {
        $this->caissesbanques = $this->getRoute()->getObject();

        $this->form = $this->configuration->getForm($this->caissesbanques);
    }

    public function executeSavespiecepreengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);


            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];

            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
            $idlignerubrique = $params['idlignerubrique'];
            $ligne = new Ligneoperationcaisse();
            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                // die($lignesbudgets);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            $ligne->setNumeroo($numero);
            $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            $ligne->setIdCaisse($id_caisse);
            $ligne->setIdDocachat($iddoc_achat);
            $ligne->setObjet($objet);
            $ligne->setDateoperation($date);
            $ligne->setIdCategorie($idCatoperation);
            $ligne->setMntoperation($mnt);
            $ligne->setIdBudget($idlignerubrique);
            if ($chequen)
                $ligne->setChequen($chequen);
            $ligne->save();
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }

            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            die('bien');
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
//        $filter = $this->filters;
//        $ciassebanque = Doctrine_Core::getTable('caissesbanques')
//                        ->createQuery('a')->where('id_typecb=' . $idtype);
//       
//        $query = $ciassebanque->OrderBy('id desc');
//        $this->filters
        $this->addSortQuery($query);
//        $query = $query->where('id_typecb=1')->OrderBy('id desc');
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeListeCompteForTransfert(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];

            $q = Doctrine_Query::create()
                    ->select("id, libelle, rib as codeop")
                    ->from('caissesbanques')
                    ->where('id <>' . $id)
                    ->andWhere("id_typecb = 1");
            $q = $q->orderBy('libelle')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeAddnewsolde(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $mnt = $params['mnt'];
            Doctrine_Query::create()
                    ->update('caissesbanques')
                    ->set('mntouverture', '?', $mnt)
                    ->set('mntprov', '?', $mnt)
                    ->set('mntdefini', '?', $mnt)
                    ->where('id=' . $id)
                    ->execute();
            die('bien');
        }
        die('Erreur');
    }

    public function executeLastOpeartionInCompte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($id);
            if ($mvt != null)
                die(json_encode($mvt->getNumero()));
            else
                die(json_encode(''));
        }
        die('Erreur');
    }

    public function executeAffichedetailcaisse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];

            $q = Doctrine_Query::create()
                            ->select("*")
                            ->from('caissesbanques')->where('id=' . $id)->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeImprimerCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        $caisse = CaissesbanquesTable::getInstance()->find($id);

        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Caisse');
        $pdf->SetSubject("document du caisse");
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
//      


        $html = $this->ReadHtmlCaisse($caisse);

        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlCaisse($caisse) {
        $html = StyleCssHeader::header1();
        $html .= $caisse->ReadHtmlCaisse();

        return $html;
    }

}
