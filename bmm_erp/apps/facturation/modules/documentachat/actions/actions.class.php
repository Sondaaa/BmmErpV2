<?php

require_once dirname(__FILE__) . '/../lib/documentachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/documentachatGeneratorHelper.class.php';

/**
 * documentachat actions.
 *
 * @package    Bmm
 * @subpackage documentachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentachatActions extends autoDocumentachatActions {

    protected $id_type = 2;
    protected $type_doc = '';

    public function executeAfficheligneListeboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_bce = $params['id'];
            $id_Bon_Comm_Interne = explode(',', $id_bce);
            //            $array = array($id_Bon_Comm_Interne);
            $query = "select lignedocachat.mntht ,designationarticle as designation,
                        lignedocachat.nordre as norgdre, lignedocachat.id, 
                      lignedocachat.observation as observation ,
                      CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht,
                      lignedocachat.mntht as totalhax , " .
                    " tauxfodec.libelle  as tauxfodec , tauxfodec.id as idtaufodec,"
                    . " tva.id as idtva, lignedocachat.mntfodec as fodec, "
                    . "  tva.libelle as tva," . "  lignedocachat.mntttc  as totalttc, "
                    . " lignedocachat.qte as qte,"
                    . " id_articlestock as id_articlestock,  "
                    . " codearticle as codearticle , documentachat.droittimbre as droittimbre , lignedocachat.mntremise as tauxremise "
                    . " from lignedocachat,tauxfodec,tva,documentachat "
                    . " where id_doc =" . $id_bce
                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id"
                    . " and tva.id=lignedocachat.id_tva"
                    . " and documentachat.id=lignedocachat.id_doc"
// . " group by (observation, id_articlestock, lignedocachat.unitedemander, lignedocachat.mntht, designation, codearticle, id_unitemarche, id_projet,lignedocachat.id)"
                    . " order by lignedocachat.id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeSavebonexternejeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $listeslignesdoc = $params['listearticle'];
            $total_ttc_provisoire = $params['total_ttc_provisoire'];
            $droit_timbre_societe = $params['droit_timbre_societe'];
            $achat_document = DocumentachatTable::getInstance()->find($iddoc);
            $documentachat = $achat_document;
            $documentachat->setIdUser($user->getId());
            if ($droit_timbre_societe)
                $documentachat->setDroittimbre($droit_timbre_societe);
            $documentachat->setDatecreation(date('Y-m-d'));
            if ($total_ttc_provisoire)
                $documentachat->setMntttc($total_ttc_provisoire);
            $documentachat->save();
            $lignes_docachat = LignedocachatTable::getInstance()->findByIdDoc($documentachat->getId());
            foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                $lignedocachat->getQtelignedoc()->delete();
                $lignedocachat->delete();
            }
            $mntht = 0;
            $mntttc = 0;
            $montanttotaltva = 0;
            $montanttotalfodec = 0;
            $pttva = 0;

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $id_tva = $lignedoc['idtva'];
                $unite = $lignedoc['unitedemander'];
                $observation = $lignedoc['observation'];
                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
                $prixttc = $lignedoc['prixttc'];
                $taufodec = $lignedoc['idtaufodec'];
                $totalhtax = $lignedoc['totalhTax'];

                $totalhax = $lignedoc['totalhax'];
                $tauxremise = $lignedoc['tauxremise'];
                $totalttc = $lignedoc['totalttc'];
                $id_unitemarche = $lignedoc['id_unitemarche'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                if ($id_unitemarche && $id_unitemarche != "")
                    $lignedoc->setIdUnitemarche($id_unitemarche);
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);

                $mntht += $totalhax;
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMnhtaxnet($totalhax);
                if ($totalhtax && $totalhtax != "")
                    $lignedoc->setMntht($totalhtax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($idtva) {
                    $lignedoc->setIdTva($idtva);
                } else {
                    $tvas = Doctrine_Core::getTable('tva')->findAll();
                    foreach ($tvas as $tva) :
                        if ($tva->getValeurtva() == 0.00)
                            $id_tva_null = $tva->getId();
                    endforeach;
                    $lignedoc->setIdTva($id_tva_null);
                }

                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;

                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                else {
                    $tauxfodecs = Doctrine_Core::getTable('tauxfodec')->findAll();
                    foreach ($tauxfodecs as $tauxfodec) :
                        if ($tauxfodec->getValeur() == 0)
                            $id_tauxfodec_null = $tauxfodec->getId();
                    endforeach;
                    $lignedoc->setIdTauxfodec($id_tauxfodec_null);
                }
                if ($tauxremise) {
                    $tauxremise = $tauxremise * 100;
                    $lignedoc->setMntremise($tauxremise);
                }
                $lignedoc->setObservation($observation);
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
            }


            if ($total_ttc_provisoire)
                $documentachat->setMntttc($total_ttc_provisoire);
//            if ($total_htax)
//                $documentachat->setMht($total_htax);
//            if ($montanttotaltva)
//                $documentachat->setMnttva($montanttotaltva);
//            if ($montanttotalfodec)
//                $documentachat->setMntfodec($montanttotalfodec);
            $documentachat->save();
            return $this->renderText(json_encode(array(
                        'idbdc' => $documentachat->getId(),
                        'tab' => '4'
            )));
        }
        return $this->renderText(json_encode(array(
                    'error' => 'ERROR'
        )));
    }

//__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeMisajourlignejeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idligne = $params['idligne'];

            $qte = $params['qte'];
            $idtva = $params['idtva'];
            $mnht = $params['mnht'];
            $iddoc = $params['iddoc'];
            $lignedoc = new Lignedocachat();
            $linges = Doctrine_Core::getTable('lignedocachat')->findOneById($idligne);
            if ($linges) {
                $lignedoc = $linges;

                $qtelignedoc = new Qtelignedoc();

                $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lignedoc->getId());

                if ($qteligne) {

                    $qtelignedoc = $qteligne;
                    $qtelignedoc->setQtelivrefrs($qte);
                    $qtelignedoc->save();
                }
//mnt tva
                $tvas = Doctrine_Core::getTable('tva')
                                ->createQuery('a')->where("libelle like '" . trim($idtva) . "'")->execute();
//                Doctrine_Core::getTable('tva')->findOneBy(trim($idtva));
//die('gg');
                if (count($tvas) > 0) {
                    $tva = $tvas[0];
                    $lignedoc->setIdTva($tva->getId());
                    $mmntva = $mnht * ($tva->getValeurtva() / 100);
                    $lignedoc->setMnttva($mmntva);
                    $mntttc = $mnht + $mmntva;
                    $lignedoc->setMntttc($mntttc);
                    $lignedoc->setMntht($mnht);
                }
                $lignedoc->save();
                $documentachat = new Documentachat();
                $document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
                if ($document) {
                    $documentachat = $document;
                    $lignesdocs = $documentachat->getLignedocachat();
                    $totalht = 0;
                    $totaltva = 0;
                    $totalttc = 0;
                    $qtelig = 0;
                    foreach ($lignesdocs as $ligne) {
// die($ligne->getId().'jj');
                        $qtelignedoc = new Qtelignedoc();
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                        if ($qteligne) {
                            $qtelignedoc = $qteligne;
                            $qtelig = $qtelignedoc->getQtelivrefrs();
//die($qtelig.'hh');
                        }
                        $totalht+=$ligne->getMntht() * $qtelig;
                        $totaltva+=$ligne->getMnttva() * $qtelig;
                        $totalttc+=$ligne->getMntttc() * $qtelig;
                    }
                    $documentachat->setMnthtax($totalht);
                    $documentachat->setMnttva($totaltva);
                    $documentachat->setMntttc($totalttc);
                    $documentachat->save();
                    die(number_format($totalttc, 3, ',', '.') . '');
                }
            }
        }
        die('bien');
    }

    public function executeSupprimerlignejeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idligne = $params['idligne'];
            $iddoc = $params['iddoc'];
            $lignedoc = new Lignedocachat();
            Doctrine_Query::create()->delete('qtelignedoc')
                    ->where('id_lignedocachat=' . $idligne)->execute();

            $lignedocachat = LignedocachatTable::getInstance()->find($idligne);
            $nordre = $lignedocachat->getNordre();
            $liste_lignedocachat = LignedocachatTable::getInstance()->getByDocOrderByTvaBeforeDelete($iddoc, $nordre);
            foreach ($liste_lignedocachat as $la) {
                $la->setNordre($nordre);
                $la->save();
                $nordre++;
            }

            $query = Doctrine_Query::create()->delete('lignedocachat')
                            ->where('id=' . $idligne)->execute();
            $documentachat = new Documentachat();
            $document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

            if ($document) {
                $documentachat = $document;
                $lignesdocs = $documentachat->getLignedocachat();
                $totalht = 0;
                $totaltva = 0;
                $totalttc = 0;
                $qtelig = 0;
                foreach ($lignesdocs as $ligne) {
                    $qtelignedoc = new Qtelignedoc();
                    $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                    if ($qteligne) {
                        $qtelignedoc = $qteligne;
                        $qtelig = $qtelignedoc->getQtelivrefrs();
                    }
                    $totalht+=$ligne->getMntht() * $qtelig;
                    $totaltva+=$ligne->getMnttva() * $qtelig;
                    $totalttc+=$ligne->getMntttc() * $qtelig;
                }
                $documentachat->setMnthtax($totalht);
                $documentachat->setMnttva($totaltva);
                $documentachat->setMntttc($totalttc);
                $documentachat->save();
                die(number_format($totalttc, 3, ',', '.') . '');
            }
        }
        die('bien');
    }

//__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeValideretenvoyer(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn') && $request->getParameter('btn') == "envoyer") {
//______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;

                if ($documentachat->getIdTypedoc() != 9)
                    $documentachat->setIdEtatdoc(9);
                else
                    $documentachat->setIdEtatdoc(6);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeNew(sfWebRequest $request) {
        $this->idtype = 6;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();

        $this->documentachat->setIdTypedoc($this->idtype);
// die($this->documentachat->NumeroSeqDocumentAchat().'hh');
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }

    public function executeListeMvt(sfWebRequest $request) {
//        $this->listmvt = $this->getListeMvt();
    }

    public function executeIndexBdcG(sfWebRequest $request) {
//        $this->listmvt = $this->getListeMvt();
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            // $this->setFilters($this->configuration->getFilterDefaults());
            // $this->redirect('@documentachat');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@documentachat');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    public function executeIndex(sfWebRequest $request) {
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
            $this->idtype = $idtype;
        }
        if ($request->getParameter('type')) {
            $type = $request->getParameter('type');
            $this->type_doc = $request->getParameter('type');
        }
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $this->idtype = $idtype;
        $this->type = $type;
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
    }

    protected function getPager($idtype) {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();
        return $pager;
    }

    protected function buildQuery($idtype) {
        $type = $this->type_doc;
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        $filter = $this->getFilters();
        if ($idtype == '') {
            if ($filter['id_typedoc']) {
                $idtype = $filter['id_typedoc'];
            }
        }
        // echo $idtype . 'dc';
        $this->idtype = $idtype;
        //echo $idtype . 'typee';
        $documentsachat = Doctrine_Core::getTable('documentachat')
                ->createQuery('a');
        if ($idtype != "" && $idtype == "7") {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=' . $idtype)
                    ->OrderBy('id desc');
        } elseif ($idtype == "2" && $type == "") {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc in (2)')
                    ->andWhere('a.id_frs is not null')
                    ->OrderBy('id desc');
        } elseif ($idtype == "22" && $type == "BDCG") {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')->where('id_typedoc in (22)')
                    ->andWhere('a.id_frs is  null')
                    ->andWhere('datesignature is not null ')
//                    ->andWhere('a.id_etatdoc = 65')
                    ->OrderBy('id desc');
        } elseif ($idtype == "15") {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')->where('id_typedoc in (15)')
                    ->andWhere('a.id_frs is not null')
                    ->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'")
                    ->OrderBy('id desc');
        } elseif ($idtype != "" && $idtype == "6") {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')->where('id_typedoc in (6)')
                    ->andWhere('a.id_frs is not null')
                    ->andWhere('a.id_contrat is not null')
                    ->OrderBy('id desc');
        } elseif ($idtype != "" && $idtype == 20) {
            $documentsachat = Doctrine_Core::getTable('lignemouvementfacturation')
                    ->createQuery('l')
                    ->select('*')
                    ->from('lignemouvementfacturation l ,documentachat')
                    ->where('l.id_documentachat is not null ')
                    ->andWhere('l.id_documentachat=documentachat.id')
                    ->andWhere('documentachat.id_typedoc=' . 20)
                    ->OrderBy('l.id desc');
        }
        //die($idtype.'f'.$documentsachat);
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->AndWhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->AndWhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->AndWhere("datecreation>='" . $filter['datecreation']['from'] . "'");

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->AndWhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $documentsachat = $documentsachat->AndWhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->AndWhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }
        if (($filter['id_typedoc'])) {
            $documentsachat = $documentsachat->Andwhere('id_typedoc=' . $filter['id_typedoc']);
        }

        if (isset($filter['id_frs'])) {
            $documentsachat = $documentsachat->Andwhere('id_frs=' . $filter['id_frs']);
        }
        $query = $documentsachat;
        //die($query ."dd".$idtype."fd".$filter['id_typedoc'] );
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

//    protected function buildQuery($idtype, $type_fac) {
//        $type = $this->type_doc;
//
//        $tableMethod = $this->configuration->getTableMethod();
//        if (null === $this->filters) {
//            $this->filters = $this->configuration->getFilterForm($this->getFilters());
//        }
//        $filter = $this->getFilters();
//        if ($idtype == '') {
//            if ($filter['id_typedoc']) {
//                $idtype = $filter['id_typedoc'];
//            }
//        }
//        // echo $idtype . 'dc';
//        $this->idtype = $idtype;
//        //echo $idtype . 'typee';
//        $documentsachat = Doctrine_Core::getTable('documentachat')
//                ->createQuery('a');
//        if ($idtype != "" && $idtype == "7") {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')
//                    ->where('id_typedoc=' . $idtype)
//                    ->OrderBy('id desc');
//        } elseif ($idtype == "2" && $type == "") {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')
//                    ->where('id_typedoc in (2)')
//                    ->andWhere('a.id_frs is not null')
//                    ->OrderBy('id desc');
//        } elseif ($idtype == "22" && $type == "BDCG") {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')->where('id_typedoc in (22)')
//                    ->andWhere('a.id_frs is  null')
//                    ->andWhere('datesignature is not null ')
//                    //                    ->andWhere('a.id_etatdoc = 65')
//                    ->OrderBy('id desc');
//        } elseif ($idtype == "15" && $type_fac == '') {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')->where('id_typedoc in (15)')
//                    ->andWhere('a.id_frs is not null')
//                    ->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
//                    ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'")
//                    ->Andwhere("id_docparent is not null")
//                    ->OrderBy('id desc');
//        } elseif ($idtype != "" && $idtype == "6") {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')->where('id_typedoc in (6)')
//                    ->andWhere('a.id_frs is not null')
//                    ->andWhere('a.id_contrat is not null')
//                    ->OrderBy('id desc');
//        } elseif ($idtype != "" && $idtype == 20) {
//            $documentsachat = Doctrine_Core::getTable('lignemouvementfacturation')
//                    ->createQuery('l')
//                    ->select('*')
//                    ->from('lignemouvementfacturation l ,documentachat')
//                    ->where('l.id_documentachat is not null ')
//                    ->andWhere('l.id_documentachat=documentachat.id')
//                    ->andWhere('documentachat.id_typedoc=' . 20)
//                    ->OrderBy('l.id desc');
//        } elseif ($idtype == "15" && $type_fac != '') {
//            $documentsachat = Doctrine_Core::getTable('documentachat')
//                    ->createQuery('a')->where('id_typedoc in (15)')
//                    ->andWhere('a.id_frs is not null')
//                    ->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
//                    ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'")
//                    ->andWhere("a.id_docparent is null")
//                    ->OrderBy('id desc');
//        }
//        //die($idtype.'f'.$documentsachat);
//        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
//            $documentsachat = $documentsachat->AndWhere("datecreation>='" . $filter['datecreation']['from'] . "'");
//            $documentsachat = $documentsachat->AndWhere("datecreation<='" . $filter['datecreation']['to'] . "'");
//        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
//            $documentsachat = $documentsachat->AndWhere("datecreation>='" . $filter['datecreation']['from'] . "'");
//
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
//        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
//            $documentsachat = $documentsachat->AndWhere("datecreation<='" . $filter['datecreation']['to'] . "'");
//        } else {
//            $documentsachat = $documentsachat->AndWhere("datecreation>='" . date('Y') . "-01-01" . "'");
//            $documentsachat = $documentsachat->AndWhere("datecreation<='" . date('Y') . "-12-31" . "'");
//        }
//        if (($filter['id_typedoc'])) {
//            $documentsachat = $documentsachat->Andwhere('id_typedoc=' . $filter['id_typedoc']);
//        }
//
//        if (isset($filter['id_frs'])) {
//            $documentsachat = $documentsachat->Andwhere('id_frs=' . $filter['id_frs']);
//        }
//        $query = $documentsachat;
//        //die($query ."dd".$idtype."fd".$filter['id_typedoc'] );
//        $this->addSortQuery($query);
//
//        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
//        $query = $event->getReturnValue();
//
//        return $query;
//    }

    public function executeArticlebycodeanddesignation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $codearticle = $params['codearticle'];
            $designation = strtoupper($params['designation']);
            $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref, article.designation as name")
                    ->from('article');
            if ($codearticle != "" && $designation == "")
                $q = $q->where("codeart like '%" . $codearticle . "%'");
            if ($codearticle == "" && $designation != "")
                $q = $q->Where("upper(designation) like '%" . $designation . "%'");
            if ($codearticle != "" && $designation != "")
                $q = $q->Where("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");

            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

//_________________________________________________Listes des Projets du société
    public function executeProjetparmotif(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');


        $q = Doctrine_Query::create()
                ->select("id,libelle as name")
                ->from('projet');
//die($q);
        $listesprojets = $q->fetchArray();
        die(json_encode($listesprojets));
    }

//_________________________________________________Listes des motif par projet
    public function executeListesmotifparprojet(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $projet = $params['idprojet'];
            $motiftext = strtoupper($params['motiftext']);
            $q = Doctrine_Query::create()
                    ->select("r.id,r.libelle as name")
                    ->from('rubrique r')
                    ->leftJoin('ligprotitrub l on r.id=l.id_rubrique')
                    ->where('r.id_rubrique is not null')
                    ->andwhere('l.id_projet=' . $projet);
            if ($motiftext != "")
                $q = $q->andwhere("upper(rubrique.libelle) like '%" . $motiftext . "%'");

            $listemotif = $q->fetchArray();
            die(json_encode($listemotif));
        }

// die($q);

        die('bien');
    }

//_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $ref = $params['ref'];
            $listeslignesdoc = $params['listeslignesdoc'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
//______________________ajouter document achat
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat(6);
            $documentachat->setNumero($numero);
            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {


                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $motif = $lignedoc['motif'];
                $projet = $lignedoc['projet'];
                $idprojet = $lignedoc['idprojet'];
                $mid = $lignedoc['mid'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
//$lignedoc->setEtatligne("EnCours");
//$lignedoc->setQtedemander($qte);


                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);

//____________________________________rech article en stock
                if ($codearticle != "" && $designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeartAndDesignation($codearticle, $designation);
                    if ($article)
                        $lignedoc->setIdArticlestock($article->getId());
                }
//_____________________________________Fin recherche
                if ($idprojet != '')
                    $lignedoc->setIdProjet($idprojet);
                if ($motif != '')
                    $lignedoc->setImpbudget($motif);

//___________________________________rech motif par budget et par projet
                if ($idprojet != "" && $mid != "") {
                    $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
                    if ($motifparprojet)
                        $lignedoc->setCodebudget($motifparprojet->getId());
                }
                $lignedoc->save();
                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($lignedoc->getId());
                $lignedocqte->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

//________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request) {
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            Doctrine_Query::create()
                    ->update('documentachat')
                    ->set('id_etatdoc', '?', 10)
                    ->where('id=' . $iddoc)
                    ->execute();
            $this->redirect('documentachat/showdocument?iddoc=' . $iddoc);
        }
        $this->redirect('@documentachat');
    }

//__________________________________________________Afficher document
    public function executeShowdocument(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

//__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeEnvoistock(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
//______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(2);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

//__________________________________________________Envoie fiche vers budget
    public function executeEnvoibudget(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
//______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

//__________________________________________________________________________Supprimer fiche et ligne document d'achat
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

//        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $iddoc = $request->getParameter('id');
//_________suppr. ligne doc
        Doctrine_Query::create()->delete('lignedocachat')
                ->where('id_doc=' . $iddoc)->execute();
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');


        $this->redirect('@documentachat');
    }

//__________________________________________________Ajouter visa bci et transformer bce
    public function executeRempliretexporter(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
//______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeAjoutervisa(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idvisa = $params['idvisa'];
            $datevisa = $params['datevisa'];
            if ($idvisa != 0) {
                $lignevisadoc = new Ligavissig();
                $ligne = Doctrine_Core::getTable('ligavissig')->findOneByIdDocAndIdVisa($iddoc, $idvisa);
                if ($ligne)
                    $lignevisadoc = $ligne;
                $lignevisadoc->setIdDoc($iddoc);
                $lignevisadoc->setIdVisa($idvisa);
                $lignevisadoc->setDatevisa($datevisa);
                $lignevisadoc->save();
            }
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT   visaachat.chemin,  CONCAT(visaachat.libelle,'',agents.nomcomplet) as ag, "
                    . " ligavissig.id,ligavissig.datevisa "
                    . "FROM    documentachat,  visaachat,   ligavissig,   agents "
                    . "WHERE   visaachat.id_agent = agents.id "
                    . "AND   ligavissig.id_visa = visaachat.id "
                    . "AND   ligavissig.id_doc = documentachat.id   "
                    . "AND documentachat.id=" . $iddoc;
//die($query);
            $listevisadoc = $conn->fetchAssoc($query);

            die(json_encode($listevisadoc));
        }

// die($q);

        die('bien');
    }

//________________________________________________________________________Chois des article a partir document achat
    public function executeChoisarticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $designation = $params['designation'];


            $query = "select lignedocachat.id,designationarticle as name,qtelignedoc.qteaachat as ref "
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc=" . $iddoc . " and qtelignedoc.id_lignedocachat=lignedocachat.id";
            if ($designation != "")
                $query .= " and designationarticle like '%" . $designation . "%' ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die('Erreur ....!!!');
    }

//_________________________________________________Ajouter nouveau fiche demande de prix par type: BCI
    public function executeSavedocumentprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $delai = $params['delai'];
            $datemax = date('Y-m-d', strtotime($params['datemax']));

            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
//______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat(8);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(8);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(10);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setDelaifrs($delai);
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
//                $lignedoc->setEtatligne("EnCours");
                $lignedoc->setDesignationarticle($designation);

                $lignedoc->save();
                $qteachat = new Qtelignedoc();
                $qteachat->setIdLignedocachat($lignedoc->getId());
                $qteachat->setQteaachat($qte);
                $qteachat->save(); //die($qteachat.'hh');
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Demande de prix créée avec succès");
        }
        die('Erreur .....!!!!');
    }

//_____________________________________________________Liste document demande de prix
    public function executeListedemandeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=8 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
// die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebondeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=2 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
// die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//__________________________________________________________________________Liste bon de commande externe
    public function executeListebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=7 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
// die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//__________________________________________________________________________Liste bon de commande interne
    public function executeListeboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $texte = strtoupper($params['recherche']);
            if ($texte != "")
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id and typedoc.id=6 "
                        . "and   (documentachat.numero::text like '%" . $texte . "%' or upper(documentachat.reference) like '%" . $texte . "%' "
                        . "or documentachat.datecreation::text like '%" . $texte . "%' "
                        . "or upper(agents.nomcomplet) like '%" . $texte . "%')";
            else
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   "
                        . "documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id  "
                        . "and typedoc.id=6  LIMIT 5";
//die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//___________________________________________________________________________Detail ligne doc Detaillignedemandeprix
    public function executeDetaillignedemandeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];


            $query = "select lignedocachat.id as idligne,documentachat.id as demandedeprixid,"
                    . "lignedocachat.nordre,lignedocachat.designationarticle,   "
                    . "fournisseur.rs,qtelignedoc.qteaachat, fournisseur.adr as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:', fournisseur.tel,' Gsm:', fournisseur.gsm) as annuaire  "
                    . "from fournisseur, lignedocachat, documentachat ,qtelignedoc "
                    . "where   lignedocachat.id=qtelignedoc.id_lignedocachat "
                    . "and lignedocachat.id_doc = documentachat.id  "
                    . "AND documentachat.id_frs = fournisseur.id AND documentachat.id=" . $idlignedoc . " "
                    . " group by idligne, demandedeprixid,lignedocachat.nordre,"
                    . "lignedocachat.designationarticle, "
                    . " fournisseur.rs,annuaire,qtelignedoc.qteaachat, fournisseur.adr;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//___________________________________________________________________________Passer le BCI(les demande de prix ) en BCE ou BCC
    public function executeEtapefinal(sfWebRequest $request) {
        if ($request->getParameter('iddoc')) {
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 10) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 12)
                        ->where('id=' . $request->getParameter('iddoc'))
                        ->execute();
            }
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 9) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 11)
                        ->where('id=' . $request->getParameter('iddoc'))
                        ->execute();
            }
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 11) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 13)
                        ->where('id=' . $request->getParameter('iddoc'))
                        ->execute();
            }
        }
        $this->redirect('documentachat/index');
    }

//__________________________________________________________________________Expoter BDC
    public function executeExportbcc(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 2);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

//__________________________________________________________________________Expoter BCE
    public function executeExportbce(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

//__________________________________________________________________________Listes des TVA
    public function executeListetva(sfWebRequest $request) {

        $listes_tva = Doctrine_Query::create()
                ->select("*")
                ->from('tva');

        $listes_tva = $listes_tva->fetchArray();
        die(json_encode($listes_tva));
    }

//__________________________________________________________________________Ajouter bon de deponse 
    public function executeSavebondedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $reference = $params['reference'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
//______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat(2);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(2);
            $documentachat->setIdDocparent($achat->getId());
            if ($reference)
                $documentachat->setReference($reference);
            else
                $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(12);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->save();
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $idtva = $lignedoc['idtva'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
//$lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
//$lignedoc->setQte($qte);
                $lignedoc->setMntht($puht);
                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setIdTva($idtva);
                $lignedoc->setObservation($observation);
// $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }
            $documentachat->setMht($mntht);
            $documentachat->setMntttc($mntttc);
            $documentachat->setMnttva($pttva);
            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépense aux comptant créé avec succès");
        }
        die('Erreur .....!!!!');
    }

//__________________________________________________________________________Ajouter bon de deponse 
    public function executeSavebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $datemax = $params['datemax'];
            $id_note = $params['id_note'];
            $designation = $params['designation'];

            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
//______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat(7);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(7);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(13);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->setIdNote($id_note);
            $documentachat->setDesiegniation($designation);
            $documentachat->save();
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $idtva = $lignedoc['idtva'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
// $lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
// $lignedoc->setQte($qte);
                $lignedoc->setMntht($puht);
                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setIdTva($idtva);
                $lignedoc->setObservation($observation);
// $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }
            $documentachat->setMht($mntht);
            $documentachat->setMntttc($mntttc);
            $documentachat->setMnttva($pttva);
            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de commande externe créé avec succès");
        }
        die('Erreur .....!!!!');
    }

//___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeDetaillignedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];


            $query = "select documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "   fournisseur.rs,fournisseur.adr  as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
                    . " from fournisseur, qtelignedoc,  lignedocachat,   documentachat  "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id and"
                    . "   lignedocachat.id_doc = documentachat.id  "
                    . "AND   documentachat.id_frs = fournisseur.id "
                    . " AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . " adrs ,  "
                    . "  fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";
// die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
//die($q);
    }

//___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeSignature(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $datesignature = $params['datesignature'];
            $doc_achat = new Documentachat();
            $doc = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $doc_achat = $doc;
            $doc_achat->setDatesignature($datesignature);
            $doc_achat->save();

            die("date signature ajouté avec succès le " . $datesignature);
        }
//die($q);
    }

//____________________________________________________Valider ligne 
    public function executeValiderligne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idligne = $params['id'];
            $input_enlevement = $params['input1'];
            $input_achat = $params['input2'];
            $qtelignedoc = new Qtelignedoc();
            $lgdoc = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($idligne);
            if ($lgdoc) {
                $qtelignedoc = $lgdoc;
                $qtelignedoc->setQteeachat($input_enlevement);
                $qtelignedoc->setQteaachat($input_achat);

                $qtelignedoc->save();
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

//______________________________________________________________________Affiche listes des fournisseurs
    public function executeListefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("fournisseur.id, fournisseur.rs as name,fournisseur.reference as ref ")
                ->from('fournisseur');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "")
                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");

            if ($ref != "")
                $q = $q->Where("upper(reference) like '%" . $ref . "%'");
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listefournisseur = $q->fetchArray();
        die(json_encode($listefournisseur));
    }

    public function executeListefournisseurMvt(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("fournisseur.id as id, fournisseur.rs as name ")
                ->from('fournisseur');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);

            if ($frs != "")
                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listefournisseur = $q->fetchArray();
        die(json_encode($listefournisseur));
    }

    public function executeConsuletrContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $iddoc = $request->getParameter('id');
        $contratachat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc);
        $contratachat->setConsulte(TRUE);
        $contratachat->save();
        die('bien');
    }

    public function executeListeDocAchatContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
//        LPAD(numero::text, 5, '0') as reference
//        $q = Doctrine_Query::create()
//                ->select("da.id,da.numero as reference,"
//                        . "c.datecreation, c.mnttc,c.montantcontrat,c.montantplanfonne, "
//                        . "f.rs as rs, f.id as id_frs , lg.tauxpourcentage,lg.id as id_ligne")
//                ->from('documentachat da')
//                ->leftJoin('da.Fournisseur f')
//                ->leftJoin('da.Contratachat c')
//                ->innerJoin('c.Lignecontrat lg')
////                ->leftJoin('lg.Lignecontrat lglg')
////                ->where('da.id_frs= f.id')
//                ->andWhere('lg.id in (select id_docparent from lignecontrat where id_docparent is not null)')
//                ->andWhere('da.id_typedoc = 20')
//                ->andWhere('da.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id)')
//                ->andWhere('da.id NOT IN (SELECT lignemouvementfacturation.id_documentachat FROM lignemouvementfacturation where lignemouvementfacturation.id_documentachat is not null)')
//                ->andWhere('da.etatdocachat IS NULL')
////                ->andWhere('lglg.id_docparent is not null')
//        ;
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $numero = $params['numero'];
////            if ($numero != "")
////                $q = $q->andWhere("LPAD(numero::text, 5, '0') like '%" . $numero . "%'");
//        }

        $numero = strtoupper($request->getParameter('numero'));
        $q = "SELECT da.id,LPAD(da.numero::text, 5, '0') as reference,c.datecreation, c.mnttc as mntttc,
              c.montantcontrat,c.montantplanfonne, f.rs as rs, f.id as id_frs
               , lg.tauxpourcentage as tauxpour, lg.id as id_ligne"
                . " from documentachat da ,contratachat c,fournisseur f ,lignecontrat lg"
                . " where da.id_frs= f.id "
                . " and da.id_contrat= c.id "
                . " and c.id_typedoc = 20"
                . " and lg.id_contrat=c.id"
                . " and lg.id in (select id_docparent from lignecontrat where id_docparent is not null)"
                . " AND da.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget 
                    WHERE piecejointbudget.id_documentbudget = documentbudget.id) "

//                . "  AND  da.id  IN (SELECT lignemouvementfacturation.id_documentachat
//                    FROM lignemouvementfacturation 
//                    where lignemouvementfacturation.id_documentachat is not null"
////                   ." and SUM (lignemouvementfacturation.tauxpourcetage) = 100"
//                ." )"
                . "AND da.etatdocachat IS NULL "
                . " order by id desc"

        ;
//        die($q);
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
//            if ($numero != "")
//                $q = $q->andWhere("LPAD(da.numero::text, 5, '0') like '%" . $numero . "%'");
        }
//        $q = $q->orderBy('id desc')->limit('100');
//        die($q);
//        $listeDocAchat = $q->fetchArray();
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listeDocAchat = $conn->fetchAssoc($q);
        die(trim(json_encode($listeDocAchat)));
    }

    public function executeListeLigneDocAchatContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_ligne = $params['id_ligne'];

            $id_documentachat = $params['id_documentachat'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT lignecontrat.id as id , lignecontrat.tauxpourcentage as taux ,lignecontrat.designationartcile as  libelle"
                    . " FROM lignecontrat"
                    . " WHERE lignecontrat.id_docparent =" . $id_ligne
                    . " and lignecontrat.tauxpourcentage not in ( select tauxpourcetage from lignemouvementfacturation where lignemouvementfacturation.id_documentachat=" . $id_documentachat . ")"
            ;
//            die($query);
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
    }

    //*******

    public function executeListeLigneDocAchatContratJS(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $id_ligne = $request->getParameter('id');

        $id_doc = $request->getParameter('id_doc');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT lignecontrat.id as id ,"
                . " lignecontrat.tauxpourcentage as taux "
                . " , lignecontrat.designationartcile as  libelle"
                . " FROM lignecontrat"
                . " WHERE lignecontrat.id_docparent =" . $id_ligne
                . " and lignecontrat.tauxpourcentage not in ( select tauxpourcetage"
                . " from lignemouvementfacturation"
                . " where lignemouvementfacturation.id_documentachat=" . $id_doc . ")"
        ;
        // die($query);
        $resultat = $conn->fetchAssoc($query);
        die(json_encode($resultat));
    }

    public function executeListeDocAchat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        $q = Doctrine_Query::create()
                ->select("id, CONCAT(typedoc.prefixetype, LPAD(numero::text, 7, '0'),' -- Réf--',reference) as reference, datecreation, mntttc, f.rs as rs, f.id as id_frs")
                ->from('documentachat da')
                ->leftJoin('da.Fournisseur f')
                ->leftJoin('da.Typedoc typedoc')
                ->where('(id_typedoc = 2 OR id_typedoc = 7) ')
                ->andWhere('da.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id)')
                ->andWhere('da.id NOT IN (SELECT lignemouvementfacturation.id_documentachat FROM lignemouvementfacturation where lignemouvementfacturation.id_documentachat is not null)')
                ->andWhere('etatdocachat IS NULL');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            if ($numero != "")
                $q = $q->andWhere("LPAD(numero::text, 8, '0') like '%" . $numero . "%'"
                        . " or (da.reference like '%" . $numero . "%')")
                ;
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listeDocAchat = $q->fetchArray();
//        die($q);
        die(json_encode($listeDocAchat));
    }

    public function executeGetListePourMouvement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id,"
                . " LPAD(documentachat.numero::text, 7, '0') as numero, "
                . "typedoc.prefixetype as type , documentachat.reference as reference"
                . " from documentachat, typedoc "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND (documentachat.id_typedoc = 2 OR documentachat.id_typedoc = 7 ) "
                . " AND documentachat.datesignature IS NOT NULL "
                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget"
                . " WHERE piecejointbudget.id_documentbudget = documentbudget.id "
                . ") "
                . " AND documentachat.id NOT IN (SELECT lignemouvementfacturation.id_documentachat FROM lignemouvementfacturation where lignemouvementfacturation.id_documentachat is not null) "
                . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourMouvementBCI(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, "
                . "typedoc.prefixetype as type ,documentachat.reference as reference  "
                . " from documentachat, typedoc "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND documentachat.id_typedoc = 6  "
                . " AND documentachat.id_contrat IS NOT NULL "
                . " AND documentachat.id_etatdoc = 42  "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget"
//                . " WHERE piecejointbudget.id_documentbudget = documentbudget.id "
//                . ") "
//                . " AND documentachat.id NOT IN (SELECT lignemouvementfacturation.id_documentachat FROM lignemouvementfacturation where lignemouvementfacturation.id_documentachat is not null) "
                . " order by documentachat.id desc ";
//die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourMouvementContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " typedoc.prefixetype as type, documentachat.reference as reference "
                . " from documentachat, typedoc, "
                . "  contratachat "
                . " where documentachat.etatdocachat IS NULL "
                . " and documentachat.id_contrat = contratachat.id"
                . " AND documentachat.id_typedoc = typedoc.id "
                . " and documentachat.id_typedoc = 20"
                . " AND contratachat.consulte is null "
                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget"
                . " WHERE piecejointbudget.id_documentbudget = documentbudget.id "
                . ") "
                . " AND documentachat.id NOT IN (SELECT lignemouvementfacturation.id_documentachat"
                . " FROM lignemouvementfacturation where "
                . " lignemouvementfacturation.id_documentachat is not null) "
                //. " and lignecontrat.id in (select id_docparent from lignecontrat where id_docparent is not null)"
                . " order by documentachat.id desc "
        ;
//die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourMouvementFacture(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
                . "  typedoc.prefixetype as type , documentachat.reference as reference "
                . " from documentachat, typedoc "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND (documentachat.id_typedoc = 2 OR documentachat.id_typedoc = 7 ) "
                . " AND documentachat.datesignature IS NOT NULL "
                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat"
                . " FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id) "
                // AND documentbudget.mnt IS NOT NULL
                . " AND documentachat.id IN (SELECT lignemouvementfacturation.id_documentachat "
                . "FROM lignemouvementfacturation) "
                . " AND documentachat.id NOT IN (SELECT id_docparent "
                . "FROM documentachat WHERE id_docparent IS NOT NULL AND etatdocachat IS NULL) "
                . " AND documentachat.id NOT IN (SELECT id_facture "
                . "FROM facturecomptableachat WHERE facturecomptableachat.id_facture = documentachat.id) "
                . " UNION "
                . " select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
                . " , documentachat.reference as reference "
                . " from documentachat, typedoc "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND(documentachat.id_typedoc = 20 )  "
                . " AND documentachat.datesignature IS NOT NULL "
                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat"
                . " FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id) "
                // AND documentbudget.mnt IS NOT NULL
                . " AND documentachat.id IN (SELECT lignemouvementfacturation.id_documentachat "
                . "FROM lignemouvementfacturation) "
                . " AND documentachat.id not IN (SELECT id_docparent "
                . "FROM documentachat WHERE id_typedoc = 15 AND etatdocachat IS NULL) "
                . " AND documentachat.id NOT IN (SELECT id_facture "
                . "FROM facturecomptableachat WHERE facturecomptableachat.id_facture = documentachat.id) "
                . " UNION "
                . " select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
                . " ,  documentachat.reference as reference "
                . " from documentachat, typedoc "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND(documentachat.id_typedoc = 6 )  "
                //. " AND documentachat.datesignature IS NOT NULL "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat"
//                . " FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id) "
                // AND documentbudget.mnt IS NOT NULL
                . " AND documentachat.id IN (SELECT lignemouvementfacturation.id_documentachat "
                . "FROM lignemouvementfacturation) "
                . " AND documentachat.id not IN (SELECT id_docparent "
                . "FROM documentachat WHERE id_typedoc = 15 AND etatdocachat IS NULL) "
                . " AND documentachat.id NOT IN (SELECT id_facture "
                . "FROM facturecomptableachat WHERE facturecomptableachat.id_facture = documentachat.id) "
//                . " order by documentachat.id desc"
        ;

//        die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeAnnulerDocAchat(sfWebRequest $request) {
        $documentachat = DocumentachatTable::getInstance()->find($request->getParameter('id'));
        $documentachat->setEtatdocachat('Annulé(e)');
        $documentachat->save();

        die("Ok");
    }

    public function executeImprimerBCEProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Provisoire');
        $pdf->SetSubject("Fiche B.C.E Provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBCEProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEProvisoire($iddoc);
        return $html;
    }

    public function executeImprimerBCEDefinitf(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Définitf');
        $pdf->SetSubject("Fiche B.C.E Définitf");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBCEDefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Définitf.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEDefinitif($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEDefinitif($iddoc);
        return $html;
    }

    public function executeImprimerdocachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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
 $pdf->CustomFooter($adresse, '');
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


        $html = $this->ReadHtml($societe, $aviss, $documentachat, $listesdocuments);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext+=35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);

        return $html;
    }

    public function executeImprimerdocachatContrat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $id_contrat = $documentachat->getIdContrat();
        $contrat = ContratachatTable::getInstance()->find($id_contrat);
        $listesdocuments_contrat=  Doctrine_Core::getTable('lignecontrat')
                        ->createQuery('a')
                        ->where('id_contrat=' . $id_contrat)->orderBy('id asc')->execute();
        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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


        $html = $this->ReadHtmlContratFac($societe, $aviss, $documentachat, $listesdocuments,$listesdocuments_contrat);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext+=35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratFac($societe, $aviss, $documentachat, $listesdocuments,$listesdocuments_contrat) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBCIDuContratFac($aviss, $listesdocuments,$listesdocuments_contrat);

        return $html;
    }

    public function executeDetaillignemouvement(sfWebRequest $request) {
        $doc = new Documentachat();
        $id = $request->getParameter('id');
        $this->id = $id;
        $ligne = Doctrine_Core::getTable('lignemouvementfacturation')->find(array($request->getParameter('id')));
        $this->ligne = $ligne;
        $this->documentachat = $ligne->getDocumentachat();
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
        $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();

        if ($request->getParameter('exporterjeton'))
            $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
        if ($request->getParameter('exporterfacture')) {
            $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
            if ($verif_jeton) {
                $this->ExporterBCexterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
            } else
                $this->ExporterBCexterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
        }
        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);

        if ($verif_jeton) {
            $idbce = $verif_jeton->getId();
        }
        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->lienBCEJ = 0;
        $this->lienFacture = 0;
        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
        if ($this->jeton) {
            $this->lienBCEJ = 1;
            $this->classBtnJ = "disabledbutton";
        }


//        $factures = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedocAndIdContrat($idbce, 15, $doc_achat->getIdContrat());
        $factures = Doctrine_Core::getTable('documentachat')->getByDocparentAndContrat($idbce, 15, $doc_achat->getIdContrat());
//        $this->facture = $factures;
        $somme = 0;
        foreach ($factures as $facture):
//            die(sizeof($factures).'dde'.$facture->getId());
            $somme = $somme + floatval($facture->getMntttc());
            $this->facture = $facture;
        endforeach;

        //somme des mnt == mnt ttc du contrat 
//        die('somme=' . intval($somme) . 'ttc=' . intval($doc_achat->getContratachat()->getMnttc()));
        if ($this->facture) {
            $this->lienFacture = 1;
            if (intval($somme) == intval($doc_achat->getContratachat()->getMnttc())) {
                $this->classBtnF = "disabledbutton";
            }
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    public function executeTesterSommeFacture(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $msg = 'bien';
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docachat = $params['id'];
            $total_facture = $params['total_facture'];
            $montantfacture = $params['montantfacture'];
            $total_quitance_bdcr = $params['total_quitance_bdcr'];
            $total_fac = floatval($montantfacture) + floatval($total_facture);
            if ($total_quitance_bdcr >= $total_fac)
                $msg = 1;
            else
                $msg = 0;
        }
        return $this->renderText($msg);
    }

      public function executeImprimercontrat(sfWebRequest $request) {

        $pdf = new sfTCPDF();
        $id=$request->getParameter('id');
        $documentachat=  DocumentachatTable::getInstance()->find($id);
        $iddoc = $documentachat->getIdContrat();
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignecontrat')
                        ->createQuery('a')
                        ->where('id_contrat=' . $iddoc)
                        ->orderBy('id asc')->execute();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Contrat d\'achat');
        $pdf->SetSubject("Contrat d\'achat");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs));
//$pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
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
        $pdf->AddPage("L");
        $html = $this->ReadHtmlcontrat($soc, $contrat, $listesdocuments);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Contrat d\'achat.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlcontrat($societe, $contratachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
    
        $html .= $contratachat->ReadHtmlContratFAc($listesdocuments,$contratachat);
        return $html;
    }


    public function executeImprimerboncomande(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.I');
        $pdf->SetSubject("Fiche B.C.I");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBoncommande($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.I.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBoncommande($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBoncommmande($iddoc);
        return $html;
    }

    public function executeImprimerBDCRegroupeProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Regroupe Provisoire');
        $pdf->SetSubject("Fiche B.D.C Regroupe Provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBDCRegroupeProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Regroupe Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCRegroupeProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCRegroupeProvisoire($iddoc);
        return $html;
    }

    public function executeImprimerlisteBDCRegroupeS(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Dépense au comptant Regroupe Système');
        $pdf->SetSubject("Bon Dépense au comptant Regroupe Système");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBDCRegroupeSys($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon Dépense au comptant Système.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCRegroupeSys(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCRegroupeSysteme($request);
        return $html;
    }

}
