<?php

require_once dirname(__FILE__) . '/../lib/contratachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contratachatGeneratorHelper.class.php';

/**
 * contratachat actions.
 *
 * @package    Bmm
 * @subpackage contratachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contratachatActions extends autoContratachatActions {

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->contratachat = $this->form->getObject();
        $iddoc = $request->getParameter('iddoc', '');
        $this->iddoc = $iddoc;

//         die (($liste_document_achats->getFirst()->getFournisseur()->getId()).'id=');
    }

    public function executeAfficheligneListeboninternec(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);
            $query = "select u.id as idunite,u.libelle as unite, "
                    . "lg.mntht ,designationarticle as designation, lg.qte as qte , "
//                    . "SUM(qtelignedoc.qteaachat) as qte,"
//                    . "SUM(qtelignedoc.qteaachat) as qtemax, "
                    . "id_articlestock as id_articlestock, "
                    . "codearticle,  id_projet ,observation,lg.id"
                    . " FROM lignedocachat lg "
                    . "  left Join Unitemarche u on lg.id_unitemarche=u.id "
                    . " where id_doc IN (" . implode(',', array_map('intval', $id_Bon_Comm_Interne)) . ")"
//                    . " and qtelignedoc.id_lignedocachat=lg.id_unitemarche "
//                    . " and lignedocachat.id_unitemarche=unitemarche.id"
                    . " group by (id_articlestock, lg.unitedemander,"
                    . " lg.mntht, designation, codearticle, u.id, observation, "
                    . "id_projet,u.libelle,lg.id)";
//                    . " order by lignedocachat.id asc";
//die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeIndexfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');
        $this->form = new DocumentachatFormFilter();
        $this->typedocument = "";
        $type_document = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        if ($type_document)
            $this->typedocument = $type_document->getLibelle();
//        $this->date_debut = $request->getParameter('debut');
//        $this->date_fin = $request->getParameter('fin');
        $this->date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $this->date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $this->idfrs = $request->getParameter('idfrs');
        if ($this->idtype != 19)
            $this->boncommandeexterne = $this->getDocumentAchatByPage($request);
        $this->idtype == $request->getParameter('idtype');
        if ($this->idtype == 19) {
            $pager = $this->getContratAchatByPage($request);
            $this->pager = $pager;
            $this->typedocument = 'Contrat Provisoire';
        }
        if ($this->idtype == 20) {
            $this->page = $request->getParameter('page', 1);
            $pager = $this->getContratDefinitifAchatByPage($request);
            $this->pager = $pager;
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->typedocument = 'Contrat Définitif';
        }
    }

    function getContratDefinitifAchatByPage(sfWebRequest $request) {
        $page = $request->getParameter('page');
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $idfrs = $request->getParameter('idfrs');
        $idtype = $request->getParameter('idtype');
        $pager = new sfDoctrinePager('Documentachat', 5);

        $pager->setQuery(ContratachatTable::getInstance()->getAllDocByFilterDefinitif($date_debut, $date_fin, $idtype, $idfrs));

        $pager->setPage($page);

        $this->page = $page;

        $pager->init();
        return $pager;
    }

    public function executeGoPageDef(sfWebRequest $request) {
        $pager = $this->getContratDefinitifAchatByPage($request);
// $page = $request->getParameter('page', 1);

        return $this->renderPartial("contratachat/list_contratdef", array("pager" => $pager));
    }

    public function executeGoPageProvi(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $pager = $this->getContratAchatByPage($request);
//        $page = $request->getParameter('page', 1);

        return $this->renderPartial("contratachat/list_contratprovisoire", array("pager" => $pager));
    }

    function getContratAchatByPage(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $idfrs = $request->getParameter('idfrs');
        $idtype = $request->getParameter('idtype');
        $pager = new sfDoctrinePager('Documentachat', 5);

        $pager->setQuery(ContratachatTable::getInstance()->getAllDocByFilter($date_debut, $date_fin, $idtype, $idfrs));
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    function getDocumentAchatByPage(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $idfrs = $request->getParameter('idfrs');
        $idtype = $request->getParameter('idtype');
        $pager = new sfDoctrinePager('Documentachat', 5);

        $pager->setQuery(DocumentachatTable::getInstance()->getAllDocByFilter($date_debut, $date_fin, $idtype, $idfrs));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

//__________________________________________________________________________Liste ligne contrat pour modification
    public function executeAfficheligneboninterneForEdite(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "(select  typepiececontrat.id as idunite, typepiececontrat.libelle as unite,"
                    . "lignecontrat.mntht ,lignecontrat.nordre as norgdre, "
                    . "lignecontrat.id, "
                    . "designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,"
                    . " tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet,"
                    . " projet.libelle as projet,"
                    . " lignecontrat.qte as qte  "
                    . " from lignecontrat,projet,tva,typepiececontrat,tauxfodec"
                    . " where lignecontrat.id_projet = projet.id"
                    . " and lignecontrat.id_unite=typepiececontrat.id "
                    . " and lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " and lignecontrat.id_contrat=" . $id_Contrat
                    . " and lignecontrat.id_tva=tva.id "
                    . " ) "
                    . " UNION "
                    . " (select typepiececontrat.id as idunite, typepiececontrat.libelle as unite, "
                    . "lignecontrat.mntht ,lignecontrat.nordre as norgdre, "
                    . "lignecontrat.id, "
                    . "designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet, CONCAT('', '') as projet,"
                    . " lignecontrat.qte as qte "
                    . " from lignecontrat,projet,tva,typepiececontrat,tauxfodec"
                    . " where lignecontrat.id_projet IS NULL "
                    . " and lignecontrat.id_unite=typepiececontrat.id "
                    . " and lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " and lignecontrat.id_contrat=" . $id_Contrat
                    . " and lignecontrat.id_tva=tva.id "
                    . " )"
                    . " order by id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->contratachat = ContratachatTable::getInstance()->find($id);
        $this->form = $this->configuration->getForm($this->contratachat);
        $docachat = DocumentachatTable::getInstance()->findOneByIdTypedocAndIdContrat(19, $id);
        $iddoc = $docachat->getId();
        $this->iddoc = $iddoc;
    }

    public function executeAffichefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            if ($iddoc) {
                $doc_conrat = ContratachatTable::getInstance()->find($iddoc);
                $id_frs = $doc_conrat->getIdFrs();
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT  fournisseur.id as id, fournisseur.rs as name,fournisseur.reference as ref "
                        . " FROM fournisseur ,contratachat"
//                    . " WHERE etatfrs='Actif' "
                        . " WHERE fournisseur.id=" . $id_frs
                        . " and contratachat.id_frs=fournisseur.id"
                        . " Limit 1"
                ;
//            die($query);
                $resultat = $conn->fetchAssoc($query);
                die(json_encode($resultat));
            }
        }
        die('Erreur .....!!!!');
    }

    public function executeTestexistancenumerocontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  contratachat.id as id ,"
                    . " contratachat.numero as numero "
                    . " FROM contratachat"
                    . " WHERE  contratachat.numero ='" . $code . "'"
                    . " and contratachat.numero is not null ";

            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

//enregister contrat
    public function executeSavecontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $mnttotal = $params['mnttotal'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['id_frs'];
            $type = $params['type'];
            $iddoc = $params['iddoc'];
            $iddocachat = $params['iddocachat'];
            $datesigntaure = $params['datesigntaure'];

            $datefin = $params['datefin'];
            $numero = $params['numero'];
            $reference = $params['reference'];
//            $mnt_plafon = $params['mnt_plafon'];
            $cautionement = $params['cautionement'];
            $retenuegaraentie = $params['retenuegaraentie'];
            $avance = $params['avance'];
            $penalite = $params['penalite'];
            $maxpinalite = $params['maxpinalite'];
            $typepaiement = $params['typepaiement'];
            $id_ligne_achat = $params['id_ligne_achat'];
            $designationsligne = $params['designation'];
            $id_typepiece = $params['id_typepiece'];
            $type_piece = $params['type_piece'];
            $valeur_pourcetage = $params['valeur_pourcetage'];
            $designationsligne = explode(',,', $designationsligne);
            $id_typepiece = explode(',,', $id_typepiece);
            $type_piece = explode(',,', $type_piece);
            $valeur_pourcetage = explode(',,', $valeur_pourcetage);
            if ($iddoc == '') {
                $contrat_achat = new Contratachat();
            } else {
                $contrat_achat = ContratachatTable::getInstance()->find($iddoc);
                foreach ($contrat_achat->getLignecontrat() as $lignedocachat) {
                    $lignedocachat->delete();
                }
            }
            $contrat_achat->setNumero($numero);
            if ($frs)
                $contrat_achat->setIdFrs($frs);
//            if ($type)
            $contrat_achat->setType($type);
            $contrat_achat->setTypepaiment($typepaiement);
            $contrat_achat->setIdTypedoc(19);
            if ($reference)
                $contrat_achat->setReference($reference);
            if ($iddocachat)
                $contrat_achat->setIdDoc($iddocachat);
            $contrat_achat->setIdUser($user->getId());
            $contrat_achat->setIdEtatdoc(36);
            $contrat_achat->setDatecreation(date('Y-m-d'));
            if ($datesigntaure)
                $contrat_achat->setDatesigntaure($datesigntaure);
            if ($datefin)
                $contrat_achat->setDatefin($datefin);

            if ($cautionement)
                $contrat_achat->setCautionement($cautionement);
            if ($retenuegaraentie)
                $contrat_achat->setRetenuegaraentie($retenuegaraentie);
            if ($avance)
                $contrat_achat->setAvance($avance);
            if ($penalite)
                $contrat_achat->setPenalite($penalite);
            if ($maxpinalite)
                $contrat_achat->setMaxpinalite($maxpinalite);

            $contrat_achat->save();
//            die($contrat_achat->getType() . 'llll');
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['idunite'];
//                die($unite.'id');
                if ($idtva)
                    $idtva = $lignedoc['idtva'];
                $idprojet = $lignedoc['idprojet'];
                $totalhax = $lignedoc['totalhax'];
                $totalhtva = $lignedoc['totalhtva'];
                $totalttc = $lignedoc['totalttc'];
                $fodec = $lignedoc['fodec'];
//                $taufodec = $lignedoc['taufodec'];
                $idtaufodec = $lignedoc['idtaufodec'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignecontrat();
                $lignedoc->setIdContrat($contrat_achat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite)
                    $lignedoc->setIdUnitemarche($unite);
                if ($unite)
                    $lignedoc->setIdUnite($unite);
                else {
                    $lignedoc->setIdUnite(51);
                    $lignedoc->setIdUnitemarche(51);
                }
                if ($designation != "") {
                    $lignedoc->setDesignationartcile($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                if ($puht)
                    $lignedoc->setPrixu($puht);

                if ($idtaufodec)
                    $lignedoc->setIdTauxfodec($idtaufodec);
                else {
                    $tauxfodecs = Doctrine_Core::getTable('tauxfodec')->findAll();
                    foreach ($tauxfodecs as $tauxfodec) :
                        if ($tauxfodec->getValeur() == 0)
                            $id_tauxfodec_null = $tauxfodec->getId();
                    endforeach;
                    $lignedoc->setIdTauxfodec($id_tauxfodec_null);
                }
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                if ($fodec)
                    $lignedoc->setFodec($fodec);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($totalttc)
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
                if (!empty($idprojet)) {
                    $lignedoc->setIdProjet($idprojet);
                }

                if ($idtva && $idtva != "") {
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                }
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
//                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
//                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setObservation($observation);
                $lignedoc->save();
            }
//            $contrat_achat->setMht($mntht);
            $contrat_achat->setMht($mntht);
            $contrat_achat->setMnttc($totalttc);
            $contrat_achat->setMontantcontrat($totalttc);
            if ($pttva)
                $contrat_achat->setMnttva($pttva);


            for ($i = 0; $i < sizeof($designationsligne); $i++) {

                if ($designationsligne[$i] != '' && $designationsligne[$i] != 'undefined') {
                    $ligne = new Lignecontrat();

                    if ($type_piece[$i] != '' && $type_piece[$i] != 'undefined')
                        $ligne->setIdTypepiece($type_piece[$i]);
                    if ($designationsligne[$i] && $designationsligne[$i] != 'undefined')
                        $ligne->setDesignationartcile($designationsligne[$i]);
                    if ($valeur_pourcetage[$i] && $valeur_pourcetage[$i] != 'undefined')
                        $ligne->setTauxpourcentage($valeur_pourcetage[$i]);
                    $ligne->setNordre($i);
                    $ligne->setIdDocparent($lignedoc->getId());
                    $ligne->save();
                }
            }

//            if ($mnt_plafon != "" && $mnt_plafon >= 0) {
//                $contrat_achat->setMontantplanfonne($mnt_plafon);
//            }
            if ($mnttotal != "" && $mnttotal >= 0) {
                $contrat_achat->setMontantcontrat($mnttotal);
            }
            $contrat_achat->save();
            $document_achat = new Documentachat();
            if ($iddocachat) {
                $document_achat_ancuien = DocumentachatTable::getInstance()->find($iddocachat);
                $document_achat->setNumero($document_achat_ancuien->getNumero());
                $document_achat->setReference($document_achat_ancuien->getReference());
                $document_achat->setDatecreation($document_achat_ancuien->getDatecreation());
                $document_achat->setObservation($document_achat_ancuien->getObservation());
                $document_achat->setIdDemandeur($document_achat_ancuien->getIdDemandeur());
                $document_achat->setIdTypedoc(19);
                $document_achat->setIdProjet($document_achat_ancuien->getIdProjet());
                $document_achat->setIdEtatdoc(20);
                $document_achat->setMht($mntht);
                $document_achat->setMntttc($totalttc);
                if ($pttva)
                    $document_achat->setMnttva($pttva);
                $document_achat->setIdContrat($contrat_achat->getId());

                $document_achat->setIdDocparent($iddocachat);
                $document_achat->setIdFrs($document_achat_ancuien->getIdFrs());
                $document_achat->setIdUser($document_achat_ancuien->getIdUser());
                $document_achat->setValide(true);
                $document_achat->save();
            }
            die("Contrat n° " . $contrat_achat->getNumero() . " créé avec succès");
        }
        die('Erreur .....!!!!');
    }

//contrat evc avenant 

    public function executeSavecontratAvenant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $mnttotal = $params['mnttotal'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['id_frs'];
            $type = $params['type'];
            $mnt_avenant = $params['mnt_avenant'];
            $iddoc = $params['iddoc'];
            $iddocachat = $params['iddocachat'];
            $datesigntaure = $params['datesigntaure'];
            $numero = $params['numero'];
            $reference = $params['reference'];
            $id_lignedocachat = $params['id_lignedocachat'];
//            $mnt_plafon = $params['mnt_plafon'];
            $id_ligne_achat = $params['id_ligne_achat'];
            $designationsligne = $params['designation'];
            $id_typepiece = $params['id_typepiece'];
            $type_piece = $params['type_piece'];
            $valeur_pourcetage = $params['valeur_pourcetage'];
            $designationsligne = explode(',,', $designationsligne);
            $id_typepiece = explode(',,', $id_typepiece);
            $type_piece = explode(',,', $type_piece);
            $valeur_pourcetage = explode(',,', $valeur_pourcetage);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $ligne_lignecontrats = LignecontratTable::getInstance()->findByIdDocparent($id_lignedocachat);
            foreach ($ligne_lignecontrats as $ligne_lignecontrat):
                $query_etat = "UPDATE Lignecontrat SET id_docparent = null "
                        . "WHERE id=" . $ligne_lignecontrat->getId();
                $resultat_etat = $conn->fetchAssoc($query_etat);
            endforeach;
            if ($iddoc == '') {
                $contrat_achat = new Contratachat();
            } else {
                $contrat_achat = ContratachatTable::getInstance()->find($iddoc);
                foreach ($contrat_achat->getLignecontrat() as $lignedocachat) {
                    $lignedocachat->delete();
                }
            }
            $contrat_achat->setNumero($numero);
            if ($frs)
                $contrat_achat->setIdFrs($frs);
            if ($type)
                $contrat_achat->setType($type);
            $contrat_achat->setIdTypedoc(20);
            if ($reference)
                $contrat_achat->setReference($reference);
            if ($iddocachat)
                $contrat_achat->setIdDoc($iddocachat);
            $contrat_achat->setIdUser($user->getId());
            $contrat_achat->setIdEtatdoc(50);
            $contrat_achat->setDatecreation(date('Y-m-d'));
            if ($datesigntaure)
                $contrat_achat->setDatesigntaure($datesigntaure);
            $contrat_achat->save();
//            die($contrat_achat->getType() . 'llll');
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['idunite'];
                $idtva = $lignedoc['idtva'];
                $idprojet = $lignedoc['idprojet'];
                $totalhax = $lignedoc['totalhax'];
                $totalhtva = $lignedoc['totalhtva'];
                $totalttc = $lignedoc['totalttc'];
                $fodec = $lignedoc['fodec'];
//                $taufodec = $lignedoc['taufodec'];
                $idtaufodec = $lignedoc['idtaufodec'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignecontrat();
                $lignedoc->setIdContrat($contrat_achat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite)
                    $lignedoc->setIdUnitemarche($unite);
                if ($unite)
                    $lignedoc->setIdUnite($unite);

                else {
                    $lignedoc->setIdUnite(51);
                    $lignedoc->setIdUnitemarche(51);
                }
                if ($designation != "") {
                    $lignedoc->setDesignationartcile($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                if ($puht)
                    $lignedoc->setPrixu($puht);
                if ($idtaufodec)
                    $lignedoc->setIdTauxfodec($idtaufodec);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                if ($fodec)
                    $lignedoc->setFodec($fodec);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($totalttc)
                    $lignedoc->setMntttc($totalttc);
                if ($idtva && $idtva != "") {
                    $lignedoc->setIdTva($idtva);
                }
                if (!empty($idprojet)) {
                    $lignedoc->setIdProjet($idprojet);
                }

                if ($idtva && $idtva != "") {
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                }
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
//                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
//                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setObservation($observation);
                $lignedoc->save();
            }
//            $contrat_achat->setMht($mntht);
            foreach ($ligne_lignecontrats as $ligne_lignecontrat):
                $ligne_lignecontrat->setIdDocparent($lignedoc->getId());
                $ligne_lignecontrat->save();
            endforeach;

            $contrat_achat->setMht($mntht);
            $contrat_achat->setMnttc($totalttc);
            if ($pttva)
                $contrat_achat->setMnttva($pttva);
            for ($i = 0; $i < sizeof($designationsligne); $i++) {
                if ($designationsligne[$i] != '' && $designationsligne[$i] != 'undefined') {
                    $ligne = new Lignecontrat();
                    if ($type_piece[$i] != '' && $type_piece[$i] != 'undefined')
                        $ligne->setIdTypepiece($type_piece[$i]);
                    if ($designationsligne[$i] && $designationsligne[$i] != 'undefined')
                        $ligne->setDesignationartcile($designationsligne[$i]);
                    if ($valeur_pourcetage[$i] && $valeur_pourcetage[$i] != 'undefined')
                        $ligne->setTauxpourcentage($valeur_pourcetage[$i]);
                    $ligne->setNordre($i);
                    $ligne->setIdDocparent($lignedoc->getId());
                    $ligne->save();
                }
            }
            if ($mnttotal != "" && $mnttotal >= 0) {
                $contrat_achat->setMontantcontrat($mnttotal);
            }
            if ($mnt_avenant != "" && $mnt_avenant >= 0) {
                $contrat_achat->setMontantavenant($mnt_avenant);
            }
            $contrat_achat->save();
            $document_achat = new Documentachat();
            if ($iddocachat) {
                $document_achat_ancuien = DocumentachatTable::getInstance()->find($iddocachat);
                $document_achat->setNumero($document_achat_ancuien->getNumero());
                $document_achat->setReference($document_achat_ancuien->getReference());
                $document_achat->setDatecreation($document_achat_ancuien->getDatecreation());
                $document_achat->setObservation($document_achat_ancuien->getObservation());
                $document_achat->setIdDemandeur($document_achat_ancuien->getIdDemandeur());
                $document_achat->setIdTypedoc(19);
                $document_achat->setIdProjet($document_achat_ancuien->getIdProjet());
                $document_achat->setIdEtatdoc(20);
                $document_achat->setMht($mntht);
                $document_achat->setMntttc($totalttc);
                if ($pttva)
                    $document_achat->setMnttva($pttva);
                $document_achat->setIdContrat($contrat_achat->getId());

                $document_achat->setIdDocparent($iddocachat);
                $document_achat->setIdFrs($document_achat_ancuien->getIdFrs());
                $document_achat->setIdUser($document_achat_ancuien->getIdUser());
                $document_achat->setValide(true);
                $document_achat->save();
            }
            die("Contrat n° " . $contrat_achat->getNumero() . " créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $docachats = DocumentachatTable::getInstance()->findByIdContrat($iddoc);
//_________suppr. ligne doc
        Doctrine_Query::create()->delete('lignecontrat')
                ->where('id_contrat=' . $iddoc)->execute();
        foreach ($docachats as $docachat):
            $docachat->delete();
            // $docachat->save();
        endforeach;
        Doctrine_Query::create()->delete('contratachat')
                ->where('id=' . $iddoc)->execute();

        $this->redirect('contratachat/indexfrs/action?idtype=19');
    }

    public function executeImprimerContrat(sfWebRequest $request) {

        $pdf = new sfTCPDF();
        $iddoc = $request->getParameter('iddoc');
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
        $html = $this->ReadHtml($soc, $contrat, $listesdocuments);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Contrat d\'achat.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtml($societe, $contratachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
//        $contratachat=new Contratachat();
        $html .= $contratachat->ReadHtmlContrat($listesdocuments);
        return $html;
    }

    public function executeAfficheligneListeboninternecontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $id_Contrat = $params['idcontrat'];
            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);

            $query = "select  unitemarche.id as idunite, unitemarche.libelle as unite,"
                    . "l.mntht ,l.nordre as norgdre, "
                    . "l.id, "
                    . "designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,"
                    . " tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet,"
                    . " pjt.libelle as projet,"
                    . " l.qte as qte  "
                    . " from lignecontrat l "
                    . " inner join tva on l.id_tva=tva.id "
                    . " left outer join unitemarche on l.id_unitemarche=unitemarche.id "
                    . " inner join tauxfodec on l.id_tauxfodec=tauxfodec.id "
                    . "  left outer join projet pjt on pjt.id=l.id_projet "

//                    . " where l.id_unitemarche=unitemarche.id"
                    // . " and ( lignecontrat.id_projet = projet.id  or  lignecontrat.id_projet is null )"
//                    . " and l.id_tauxfodec=tauxfodec.id "
                    . " where l.id_contrat=" . $id_Contrat;
            //. " and l.id_tva=tva.id ";
//                    . " group by (id_articlestock, lignedocachat.unitedemander,"
//                    . " lignedocachat.mntht, designation, codearticle, id_unitemarche, id_projet)";
//                    . " order by lignedocachat.id asc";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAffichelignelignecontratAvenant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $id_Contrat = $params['idcontrat'];

            $ligne_contrat_achat = LignecontratTable::getInstance()->findOneByIdContrat($id_Contrat);
            $id_lignecontrat = $ligne_contrat_achat->getId();
            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);

            $query = "select  typepiececontrat.id as idtypepiece, typepiececontrat.libelle as typepiece,"
                    . "lignecontrat.tauxpourcentage   as valeur_pourcetage"
                    . " ,lignecontrat.nordre as norgdre, "
                    . "lignecontrat.id, "
                    . "designationartcile as designation"
                    . " from lignecontrat,typepiececontrat"
                    . " where lignecontrat.id_typepiece=typepiececontrat.id "
                    . " and lignecontrat.id_docparent=" . $id_lignecontrat
            ;

//            die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAfficheligneListeboninternecAvenant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $id_Contrat = $params['idcontrat'];
            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);

            $query = "select  unitemarche.id as idunite, unitemarche.libelle as unite,"
                    . " lignecontrat.mntht ,lignecontrat.nordre as norgdre, "
                    . " lignecontrat.id, "
                    . " designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,"
                    . " tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet,"
                    . " projet.libelle as projet,"
                    . " lignecontrat.qte as qte  "
                    . " from lignecontrat,projet,tva,unitemarche,tauxfodec"
                    . " where lignecontrat.id_projet = projet.id"
                    . " and lignecontrat.id_unitemarche=unitemarche.id "
                    . " and lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " and lignecontrat.id_contrat=" . $id_Contrat
                    . " and lignecontrat.id_tva=tva.id ";
//                    . " group by (id_articlestock, lignedocachat.unitedemander,"
//                    . " lignedocachat.mntht, designation, codearticle, id_unitemarche, id_projet)";
//                    . " order by lignedocachat.id asc";
//            die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

//   
//        public function executeAfficheligneListeboninternecAvenant(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//
//        $params = array();
//        $content = $request->getContent();
//        $user = $this->getUser()->getAttribute('userB2m');
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $id_Bon_Comm_Interne = $params['id'];
//            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);
//            $query = " select unitemarche.id as idunite,unitemarche.libelle as unite, "
//                    . " lignedocachat.mntht  as puht,"
//                    . " designationarticle as designation,"
//                    . " SUM(qtelignedoc.qteaachat) as qte,"
//                    . " SUM(qtelignedoc.qteaachat) as qtemax, "
//                    . " id_articlestock as id_articlestock, "
//                    . " codearticle,  id_projet ,observation,lignedocachat.id"
//                    . " lignecontrat."
//                    . " from lignedocachat,qtelignedoc,unitemarche , lignecontrat"
//                    . " where id_doc IN (" . implode(',', array_map('intval', $id_Bon_Comm_Interne)) . ")"
//                   ." "
//                    . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
//                    . " and lignedocachat.id_unitemarche=unitemarche.id"
//                    . " group by (id_articlestock, lignedocachat.unitedemander,"
//                    . " lignedocachat.mntht, designation, codearticle, unitemarche.id, observation, "
//                    . "id_projet,unitemarche.libelle,lignedocachat.id)";
////                    . " order by lignedocachat.id asc";
//
//            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $listearticles = $conn->fetchAssoc($query);
//            die(json_encode($listearticles));
//        }
//        die("bien");
//    }

    public function executeAddLigne(sfWebRequest $request) {

        $id_Contrat = $request->getParameter('id_ligne_achat');
        $id_ligne = $request->getParameter('id_ligne');
        $nordre = $request->getParameter('nordre');
//        die($id_Contrat.'r'.$id_ligne.'ggggg' .$nordre);
//        die('fr' . $id_ligne . 'ghb');
        $this->id_contrat = $id_Contrat;
        $this->numero_ligne = 0;

        $this->id_ligne = $id_ligne;
        $this->nordre = $nordre;

//        $id_ligne_achat = $request->getParameter('id_ligne_achat');
//        $this->maquette = null;
//        $this->numero_externe = $request->getParameter('numero_externe');
//        $type_journal_id = $request->getParameter('type_journal_id');
//        $nature_id = $request->getParameter('nature_id');
//        $reference = $request->getParameter('reference');
//        $journal_id = $request->getParameter('journal_id');
//        if ($nature_id == '')
//            $nature_id = 7;
//        $journal = JournalcomptableTable::getInstance()->find($journal_id);
    }

    public function executeAffichelignedeligneListeboninternecontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);

            $id_Contrat = $params['idcontrat'];

            $ligne = LignecontratTable::getInstance()->findByIdContrat($id_Contrat);
//die($ligne->getLast()->getId().'id=');
            if ($ligne && sizeof($ligne) > 0) {
                $query = "select  typepiececontrat.id as idtypepiece, typepiececontrat.libelle as typepiece,"
                        . "lignecontrat.tauxpourcentage as tauxpourcentage"
                        . " ,lignecontrat.nordre as norgdre, "
                        . "lignecontrat.id, "
                        . "lignecontrat.designationartcile as designation"
                        . " from lignecontrat,typepiececontrat"
//                    . " where lignecontrat.id_contrat=" . $id_Contrat
                        . " where lignecontrat.id_typepiece=typepiececontrat.id "
                        . " and lignecontrat.id_docparent=" . $ligne->getLast()->getId()
//                    . " group by (id_articlestock, lignedocachat.unitedemander,"
//                    . " lignedocachat.mntht, designation, codearticle, id_unitemarche, id_projet)";
                        . " order by lignecontrat.id asc";
//            die($query);
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listearticles = $conn->fetchAssoc($query);
                die(json_encode($listearticles));
            }
        }
        die("bien");
    }

    public function executeImprimerbContratdefinitif(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Contrat Défifnitf ');
        $pdf->SetSubject("Fiche Contrat Défifnitf ");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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

        $html = $this->ReadHtmlContratdefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche Contrat Défifnitf .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratdefinitif($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Contratachat();
        $html .= $piece->ReadHtmlcontratdefintif($iddoc);
        return $html;
    }

    public function executeImprimerbContratProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Contrat Provisoire ');
        $pdf->SetSubject("Fiche Contrat Provisoire ");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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

        $html = $this->ReadHtmlContratprovisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche Contrat Provisoire .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratprovisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Contratachat();
        $html .= $piece->ReadHtmlcontratProvisoire($iddoc);
        return $html;
    }

    public function executeImprimerbContratdefinitifAvecpenalite(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $id_docachat = $request->getParameter('id');
        $pdf = new sfTCPDF('');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Contrat Défifnitf ');
        $pdf->SetSubject("Fiche Contrat Défifnitf ");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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

        $html = $this->ReadHtmlContratdefinitifAvecPenalite($iddoc, $id_docachat);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche Contrat Défifnitf .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratdefinitifAvecPenalite($iddoc, $id_docachat) {
        $html = StyleCssHeader::header1();
        $piece = new Contratachat();
        $html .= $piece->ReadHtmlcontratdefintifAvecPenalite($iddoc, $id_docachat);
        return $html;
    }

    public function executeListeconratprovisoireannule(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $datedebut = $request->getParameter('debut');
        $this->date_debut = $datedebut;
        $datefin = $request->getParameter('fin');
        $this->date_fin = $datefin;
        $this->idfrs = $request->getParameter('idfrs');
//        $this->pager = $this->getDocumentachatAnnuler($request);
        $year = date('Y');
        $query = "select documentcontratannulation.id as id, "
                . " documentcontratannulation.dateannulation"
                . " as dateannulation, documentcontratannulation.motifannulation as motif,"
                . " concat(contratachat.reference , ' N° ',contratachat.numero) as numero,"
                . " documentachat.datecreation as datecreation, "
                . " typedoc.libelle as type, agents.nomcomplet as user"
                . " from documentcontratannulation,contratachat ,documentachat, utilisateur, agents, typedoc "
                . " where documentcontratannulation.id_docachat=documentachat.id  "
                . " and documentachat.id_contrat=contratachat.id"
                . " and documentachat.id_typedoc=typedoc.id "
                . " and documentachat.id_typedoc=19 "
                . " AND documentcontratannulation.id_user = utilisateur.id"
                . " AND utilisateur.id_parent = agents.id "
                . " AND documentcontratannulation.valide_budget = false "
                . " and documentachat.etatdocachat is not null"
        ;
        if ($datedebut != "") {
            $query.=" And documentcontratannulation.dateannulation>='" . $datedebut . "'";
        }

        if ($datefin != "") {
            $query.=" And documentcontratannulation.dateannulation<='" . $datefin . "'";
        }
        if ($datedebut == "" && $datefin == "") {
            $query.=" And documentcontratannulation.dateannulation >= '" . $year . "-01-01' and documentcontratannulation.dateannulation <= '" . $year . "-12-31'";
        }
        $query.= "  order by documentcontratannulation.id desc";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->docs = $conn->fetchAssoc($query);
    }

    public function executeListeconratdefinitifannule(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $datedebut = $request->getParameter('debut');
        $this->date_debut = $datedebut;
        $datefin = $request->getParameter('fin');
        $this->date_fin = $datefin;
        $this->idfrs = $request->getParameter('idfrs');
//        $this->pager = $this->getDocumentachatAnnuler($request);
        $year = date('Y');
        $query = "select documentcontratannulation.id as id, "
                . " documentcontratannulation.dateannulation"
                . " as dateannulation, documentcontratannulation.motifannulation as motif,"
                . " concat(contratachat.reference , ' N° ',contratachat.numero) as numero,"
                . " documentachat.datecreation as datecreation, "
                . " typedoc.libelle as type, agents.nomcomplet as user"
                . " from documentcontratannulation,contratachat ,documentachat, utilisateur, agents, typedoc "
                . " where documentcontratannulation.id_docachat=documentachat.id  "
                . " and documentachat.id_contrat=contratachat.id"
                . " and documentachat.id_typedoc=typedoc.id "
                . " and documentachat.id_typedoc=20 "
                . " AND documentcontratannulation.id_user = utilisateur.id"
                . " AND utilisateur.id_parent = agents.id "
                . " AND documentcontratannulation.valide_budget = false "
                . " and documentachat.etatdocachat is not null"
        ;
        if ($datedebut != "") {
            $query.=" And documentcontratannulation.dateannulation>='" . $datedebut . "'";
        }

        if ($datefin != "") {
            $query.=" And documentcontratannulation.dateannulation<='" . $datefin . "'";
        }
        if ($datedebut == "" && $datefin == "") {
            $query.=" And documentcontratannulation.dateannulation >= '" . $year . "-01-01' and documentcontratannulation.dateannulation <= '" . $year . "-12-31'";
        }
        $query.=" order by documentcontratannulation.id desc";
        //. " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->docs = $conn->fetchAssoc($query);
    }

    public function executeShowAnnule(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $this->document_annule = DocumentcontratannulationTable::getInstance()->find($iddoc);
    }

    public function executeShowResilie(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $this->document_annule = DocumentcontratresiliationTable::getInstance()->find($iddoc);
    }

    public function executeAnnulationContratDefinitif(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $idcontrat = $request->getParameter('idcontrat');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $this->contratachat = ContratachatTable::getInstance()->find($idcontrat);
        $this->listesdocumentscontrat = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($idcontrat);
    }

    public function executeResulationducontrat(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $idcontrat = $request->getParameter('idcontrat');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $this->contratachat = ContratachatTable::getInstance()->find($idcontrat);
        $this->listesdocumentscontrat = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($idcontrat);
    }

    public function executeValiderAnnulationContratdefinitif(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $motif = $request->getParameter('motif');
        $url = $request->getParameter('url');
        $id_docachat = $request->getParameter('id_docachat');
//edit contrat definitif achat 
        $contratDefinitifachat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc);
        $contratDefinitifachat->setEtatdocachat('Annulé(e)');
        $contratDefinitifachat->setIdEtatdoc(47);
        $contratDefinitifachat->save();
//edit contrat provisoire achat         
        $id_contra_prov = $contratDefinitifachat->getIdDocparent();
        $contratProvisoireachat = Doctrine_Core::getTable('contratachat')->findOneById($id_contra_prov);
        $contratProvisoireachat->setEtatdocachat('Annulé(e)');
        $contratProvisoireachat->setIdEtatdoc(46);
        $contratProvisoireachat->save();

//edit doc achat contrat definitif         
        $docachatachat = Doctrine_Core::getTable('documentachat')->findOneById($id_docachat);
        $docachatachat->setEtatdocachat('Annulé(e)');
        $docachatachat->setIdEtatdoc(47);
        $docachatachat->save();
//edit doc achat contrat provisoire
        $id_doc_achat_contrat_prov = $docachatachat->getIdFils();
        $docachatachat = Doctrine_Core::getTable('documentachat')->findOneById($id_doc_achat_contrat_prov);
        $docachatachat->setEtatdocachat('Annulé(e)');
        $docachatachat->setIdEtatdoc(46);
        $docachatachat->save();


        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $valide_budget = false;
//add dans le table contratnnulation
//        $doc_annulation = DocumentcontratannulationTable::getInstance()->findOneByIdDoccontrat($iddoc);
//        if ($doc_annulation)
//            $annulation = $doc_annulation;
//        else
        /*         * **********annulation contrat definitif ****** */
        $annulation_contrat_definitif = new Documentcontratannulation();
        $annulation_contrat_definitif->setDateannulation(date('Y-m-d'));
        $annulation_contrat_definitif->setIdDocachat($id_docachat);
        $annulation_contrat_definitif->setIdDoccontrat($iddoc);
        $annulation_contrat_definitif->setIdUser($user->getId());
        $annulation_contrat_definitif->setMotifannulation($motif);
        $annulation_contrat_definitif->setUrldocscaner($url);
        $annulation_contrat_definitif->setValideBudget($valide_budget);
        $annulation_contrat_definitif->save();

        /*         * *************Annulation COntrat provisoire***************** */
        $annulation_contrat_privoire = new Documentcontratannulation();
        $annulation_contrat_privoire->setDateannulation(date('Y-m-d'));
        $annulation_contrat_privoire->setIdDocachat($id_doc_achat_contrat_prov);
        $annulation_contrat_privoire->setIdDoccontrat($id_contra_prov);
        $annulation_contrat_privoire->setIdUser($user->getId());
        $annulation_contrat_privoire->setMotifannulation($motif);
        $annulation_contrat_privoire->setUrldocscaner($url);
        $annulation_contrat_privoire->setValideBudget($valide_budget);
        $annulation_contrat_privoire->save();
//*****annulation le budget engage definitf 
        $piecejointbudget_def = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($id_docachat, 1);
        if (sizeof($piecejointbudget_def) >= 1) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget_def->getIdDocumentbudget());
            $ligpr = LigprotitrubTable::getInstance()->find($doc_budget->getIdBudget());
            $mnt_retire_enga = floatval($ligpr->getMntengage() - $contratDefinitifachat->getMontantcontrat());
            $ligpr->setMntengage($mnt_retire_enga);
            $relica = $ligpr->getMnt() - $mnt_retire_enga;
            $ligpr->setRelicaengager($relica);
            $ligpr->save();

            $piecejointbudget_def->delete();
            $doc_budget->delete();
        }
//******annulsation le budget engage provisoire*******/
        $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($id_doc_achat_contrat_prov, 4);
        if (sizeof($piecejointbudget) >= 1) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget->getIdDocumentbudget());
            $ligpr = LigprotitrubTable::getInstance()->find($doc_budget->getIdBudget());
            $mnt_retire = floatval($ligpr->getMntprovisoire() - $contratProvisoireachat->getMontantcontrat());
            $ligpr->setMntprovisoire($mnt_retire);
            $ligpr->save();

            $piecejointbudget->delete();
            $doc_budget->delete();
        }
        die('bien');
    }

    public function executeValiderResiliationContratdefinitif(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $motif = $request->getParameter('motif');
        $url = $request->getParameter('url');
        $id_docachat = $request->getParameter('id_docachat');
        $reliq = $request->getParameter('reliq');
        $credit = $request->getParameter('credit');
        $mnt_contrat_restant = $request->getParameter('mnt_contrat_restant');
        $mnt_contrat_consomme = $request->getParameter('mnt_contrat_consomme');
// die($mnt_contrat_consomme .' ss'.$mnt_contrat_restant .'xx '.$credit.' gg'.$reliq);
//edit contrat definitif achat 
        $contratDefinitifachat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc);
        $contratDefinitifachat->setEtatdocachat('Resilié(e)');
        $contratDefinitifachat->setIdEtatdoc(48);
        $contratDefinitifachat->save();
//edit doc achat contrat definitif         
        $docachatachat = Doctrine_Core::getTable('documentachat')->findOneById($id_docachat);
        $docachatachat->setEtatdocachat('Resilié(e)');
        $docachatachat->setIdEtatdoc(48);
        $docachatachat->save();

        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $valide_budget = false;
//add dans le table contratnnulation
//        $doc_annulation = DocumentcontratannulationTable::getInstance()->findOneByIdDoccontrat($iddoc);
//        if ($doc_annulation)
//            $annulation = $doc_annulation;
//        else
        /*         * **********annulation contrat definitif ****** */
        $annulation_contrat_definitif = new Documentcontratresiliation();
        $annulation_contrat_definitif->setDateresiliation(date('Y-m-d'));
        $annulation_contrat_definitif->setIdDocachat($id_docachat);
        $annulation_contrat_definitif->setIdDoccontrat($iddoc);
        $annulation_contrat_definitif->setIdUser($user->getId());
        $annulation_contrat_definitif->setMotifresiliattion($motif);
        if ($mnt_contrat_restant)
            $annulation_contrat_definitif->setMontantrestant($mnt_contrat_restant);
        if ($mnt_contrat_consomme)
            $annulation_contrat_definitif->setMontantconsomme($mnt_contrat_consomme);
        $annulation_contrat_definitif->setValideBudget($valide_budget);
        $annulation_contrat_definitif->save();
//*****annulation le budget engage definitf 
        $piecejointbudget_def = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($id_docachat, 1);
        if (sizeof($piecejointbudget_def) >= 1) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget_def->getIdDocumentbudget());
//           die($doc_budget->getIdBudget().'vf');

            $ligpr = LigprotitrubTable::getInstance()->findOneById($doc_budget->getIdBudget());
            $ligpr->setMntengage($credit);
            $ligpr->setRelicaengager($reliq);
            $ligpr->save();
            $doc_budget->setMntresteresilier($mnt_contrat_restant);
            $doc_budget->setMntconsomme($mnt_contrat_consomme);
            $doc_budget->setAnnule(true);
            $doc_budget->save();
        }

        die('bien');
    }

    public function executeListeconratdefinitifresilie(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $datedebut = $request->getParameter('debut');
        $this->date_debut = $datedebut;
        $datefin = $request->getParameter('fin');
        $this->date_fin = $datefin;
        $this->idfrs = $request->getParameter('idfrs');
        $this->pager = $this->getDocumentachatresilie($request);
    }

    function getDocumentachatresilie(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $this->texte = "";
        $this->id = "";
        $datedebut = $request->getParameter('debut');
        $this->date_debut = $datedebut;
        $datefin = $request->getParameter('fin');
        $this->date_fin = $datefin;

        $pager = new sfDoctrinePager('Documentcontratresiliation', 10);
        $pager->setQuery(DocumentcontratresiliationTable::getInstance()->getAllDocResilier($datedebut, $datefin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeRempliravenant(sfWebRequest $request) {
        $this->documentachat = DocumentachatTable::getInstance()->find($request->getParameter('id'));
        $ids = $request->getParameter('id');
        $this->ids = $ids;
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($request->getParameter('idcontrat'));
        $this->contrat = $contrat;
        $this->form = $this->configuration->getForm($this->contrat);
        $this->numerocomntrat = $contrat->getNumero();
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($ids);

        $demande_de_prix = new Documentachat(); // Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = $demande_de_prix->NumeroSeqDocumentAchat(7);
    }

    public function executeRempliravenanttype2(sfWebRequest $request) {
        $this->documentachat = DocumentachatTable::getInstance()->find($request->getParameter('id'));
        $ids = $request->getParameter('id');
        $iddoc = $request->getParameter('id');
        $this->iddoc = $iddoc;
        $this->ids = $ids;
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($request->getParameter('idcontrat'));
        $this->contrat = $contrat;
        $this->form = $this->configuration->getForm($this->contrat);
        $this->numerocomntrat = $contrat->getNumero();
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($ids);

        $demande_de_prix = new Documentachat(); // Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = $demande_de_prix->NumeroSeqDocumentAchat(7);
    }

    public function executeSaveContratdefintifAvenant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $datesigntaure = $params['datesigntaure'];
            $numero_contrat = $params['numero_contrat'];
            $reference = $params['reference'];
            $iddoc = explode(',', $iddoc);
            $listelignelignecontrat = $params['listelignecontrat'];
            $idcontrat = $params['idcontrat'];
            $contrat_document = Doctrine_Core::getTable('contratachat')->findOneById($idcontrat);
            if ($datesigntaure)
                $contrat_document->setDatesigntaure($datesigntaure);
            if ($reference)
                $contrat_document->setReference($reference);
            if ($numero_contrat)
                $contrat_document->setNumero($numero_contrat);
            $contrat_document->save();

            $ligne_contrat = LignecontratTable::getInstance()->findByIdContrat($idcontrat);
            $ligne_lignes = LignecontratTable::getInstance()->findByIdDocparent($ligne_contrat->getLast()->getId());
            $id_ligne = $ligne_contrat->getLast()->getId();
            $ligne_lignes->delete();
            $i = 0;
            foreach ($listelignelignecontrat as $lignelignedoc) {
                $norgdre = $lignelignedoc['norgdre'];
                $designation = $lignelignedoc['designation'];
                $tauxpourcentage = $lignelignedoc['tauxpourcentage'];
                $ligne = new Lignecontrat();
                $ligne->setNordre($i);
                $ligne->setIdTypepiece(3);
                $ligne->setTauxpourcentage($tauxpourcentage);
                $ligne->setDesignationartcile($designation);
                $ligne->setIdDocparent($id_ligne);
                $ligne->save();
                $i++;
            }

            die("Avenat Contrat Définitf  créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    public function executeRemplirios(sfWebRequest $request) {

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
        $this->iddocachat = $request->getParameter('id');
        $this->contratachat = Doctrine_Core::getTable('contratachat')->findOneById($request->getParameter('idcontrat'));
        $this->frs = FournisseurTable::getInstance()->findOneById($this->contratachat->getIdFrs());
        $this->form = $this->configuration->getForm($this->contratachat);
//        $this->marche = Doctrine_Core::getTable('marches')->findOneById($this->lots->getIdMarche());

        $this->OSCOMMTRAVAUX = Doctrine_Core::getTable('ordredeservicecontratachat')->findByIdContratAndIdType($this->contratachat->getId(), 1);

        $this->OSARRET = Doctrine_Core::getTable('ordredeservicecontratachat')->findByIdContratAndIdType($this->contratachat->getId(), 4);

        $this->OSREPISE = Doctrine_Core::getTable('ordredeservicecontratachat')->findByIdContratAndIdType($this->contratachat->getId(), 5);

        $this->OSS = Doctrine_Core::getTable('ordredeservicecontratachat')
                        ->createQuery('a')
                        ->where('id_contrat=' . $this->contratachat->getId())
                        ->andwhere('id_type in (1,4,5,6)')
                        ->orderBy('id asc')->execute();
//______________________________________________________________________Action pour crée décompte 2
        if ($request->getParameter('post') && $request->getParameter('post') == "creeiosc" && $request->getParameter('idtype')) {
            $ordre = new Ordredeservicecontratachat();
            $ordre->CreeOS($this->contratachat->getId(), $request->getParameter('idtype'), $request->getParameter('id'));
            $this->Redirect('contratachat/remplirios?id=' . $this->documentachat->getId() . '&idcontrat=' . $this->contratachat->getId());
        }
    }

    public function executeImprimerTableOs(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        $idcontrat = $request->getParameter('idcontrat');
// pdf object
        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Table OS');
        $pdf->SetSubject("Table OS");
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

        $html = $this->ReadHtmlTableOs($id, $idcontrat);

// Print text using writeHTMLCell()
// output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
        $pdf->Output('Table OS.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlTableOs($id, $idcontrat) {
        $html = StyleCssHeader::header1();

        $contrat = new Contratachat();
        $html .= $contrat->ReadHtmlTableOs($id, $idcontrat);

        return $html;
    }

    public function executeMisajourpiriode(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
        $this->iddocachat = $request->getParameter('id');
        $this->contratachat = Doctrine_Core::getTable('contratachat')->findOneById($request->getParameter('idcontrat'));
        $this->frs = FournisseurTable::getInstance()->findOneById($this->contratachat->getIdFrs());
        $this->form = $this->configuration->getForm($this->contratachat);
        $this->listesordredeservice = Doctrine_Core::getTable('ordredeservicecontratachat')->findByIdContrat($this->contratachat->getId());
    }

    public function executeMisajourficheContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dprovi = $params['dprovi'];
            $delaiexecution = $params['delaiexecution'];
            $dealijustifier = $params['dealijustifier'];
            $delaicontra = $params['delaicontra'];
            $piriodereel = $params['piriodereel'];
            $retard = $params['retard'];
            $id = $params['id'];
            $mnt_pinaliter = $params['mnt_pinaliter'];

            $contrat_achat = new Contratachat();
            $contratachat = Doctrine_Core::getTable('contratachat')->findOneById($id);
            if ($contratachat) {
                $contrat_achat = $contratachat;
                if ($dprovi)
                    $contrat_achat->setDatereceptionprevesoire($dprovi);
                if ($delaiexecution)
                    $contrat_achat->setDelaidexucution($delaiexecution);
                if ($retard)
                    $contrat_achat->setPirioderetard($retard);
                if ($delaicontra)
                    $contrat_achat->setDelaicontractuelle($delaicontra);
                if ($piriodereel)
                    $contrat_achat->setPireodereelexecution($piriodereel);
                if ($dealijustifier)
                    $contrat_achat->setPeriodejustifier($dealijustifier);
                if ($mnt_pinaliter)
                    $contrat_achat->setMntpenalite($mnt_pinaliter);
                $contrat_achat->save();
            }
        }

        die('bien');
    }

    public function executeMisajourPenaliteficheContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $cautionement = $params['cautionement'];
            $retenuegaraentie = $params['retenuegaraentie'];
            $avance = $params['avance'];
            $penalite = $params['penalite'];
            $maxpinalite = $params['maxpinalite'];
            $datefin = $params['datefin'];
            $delai = $params['delai'];
            $id = $params['id'];
            $contrat_achat = new Contratachat();
            $contratachat = Doctrine_Core::getTable('contratachat')->findOneById($id);
            if ($contratachat) {
                $contrat_achat = $contratachat;
                if ($cautionement)
                    $contrat_achat->setCautionement($cautionement);
                if ($retenuegaraentie)
                    $contrat_achat->setRetenuegaraentie($retenuegaraentie);
                if ($avance)
                    $contrat_achat->setAvance($avance);
                if ($penalite)
                    $contrat_achat->setPenalite($penalite);
                if ($maxpinalite)
                    $contrat_achat->setMaxpinalite($maxpinalite);
                if ($delai)
                    $contrat_achat->setDelaicontratcuel($delai);
                if ($datefin)
                    $contrat_achat->setDatefin($datefin);
                $contrat_achat->save();
            }
        }

        die('bien');
    }

    public function executeMisajourpenalite(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
        $this->iddocachat = $request->getParameter('id');
        $this->contratachat = Doctrine_Core::getTable('contratachat')->findOneById($request->getParameter('idcontrat'));
        $iddoc = $request->getParameter('id');
        $this->ids = $iddoc;
        $this->frs = FournisseurTable::getInstance()->findOneById($this->contratachat->getIdFrs());
        $this->form = $this->configuration->getForm($this->contratachat);
        $this->listesordredeservice = Doctrine_Core::getTable('ordredeservicecontratachat')->findByIdContrat($this->contratachat->getId());
        $this->tab = "";
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
    }

    public function executeMisajourdate(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $delai = $params['delai'];
            $d1 = $params['d1'];
            $delai_justifier = $params['delai_justifier'];
//            $total_delai = floatval($d1 + $delai);
//            $d1 = floor(strtotime($d1) / 31556926);
//$diffans = $anneeretraite - $age;
            $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($d1)) . '+' . $delai . ' days'));
            if ($delai_justifier == "")
                $delai_justifier = 0;
            $resultat = date('Y-m-d', strtotime(date('Y-m-d', strtotime($end)) . '+' . $delai_justifier . ' days'));
            die($resultat);
        }

        die("Erreur");
    }

    public function executeImprimerlisteContratachatAnnuler(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des Contrats Annulés ');
        $pdf->SetSubject("Listes des Contrats Annulés");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocumentContratAnnule($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Listes Contrats Annulés' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocumentContratAnnule(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlContratAnnule($request);
        return $html;
    }

    public function executeImprimerlisteContratachatProvisoireAnnule(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des Contrats Provisoire Annulés ');
        $pdf->SetSubject("Listes des Contrats Provisoire Annulés");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocumentContratProvisoireAnnule($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Listes Contrats Provisoire Annulés' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocumentContratProvisoireAnnule(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlContratProvisoireAnnule($request);
        return $html;
    }

    public function executeImprimerlisteContratachatDefresilie(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des Contrats Définitifs Résilies ');
        $pdf->SetSubject("Listes des Contrats Définitifs Résilies");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocumentContratResilie($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Listes Contrats Définitifs Résilies' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocumentContratResilie(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlContratResilie($request);
        return $html;
    }

    public function executeExporterlisteContratAnnule(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');

        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
    }

    public function executeExporterlisteContratProvisoireAnnule(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');

        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
    }

    public function executeExporterlisteContratResilie(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
    }

    public function executeAfficheligneContratForEdite(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "(select  unitemarche.id as idunite, unitemarche.libelle as unite,"
                    . "lignecontrat.mntht ,lignecontrat.nordre as norgdre, "
                    . "lignecontrat.id, "
                    . "designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,"
                    . " tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet,"
                    . " projet.libelle as projet,"
                    . " lignecontrat.qte as qte  "
                    . " from lignecontrat,projet,tva,unitemarche,tauxfodec"
                    . " where lignecontrat.id_projet = projet.id"
                    . " and lignecontrat.id_unite=unitemarche.id "
                    . " and lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " and lignecontrat.id_contrat=" . $id_Contrat
                    . " and lignecontrat.id_tva=tva.id "
                    . " ) "
                    . " UNION "
                    . " (select unitemarche.id as idunite, unitemarche.libelle as unite, "
                    . "lignecontrat.mntht ,lignecontrat.nordre as norgdre, "
                    . "lignecontrat.id, "
                    . "designationartcile as designation, codearticle as codearticle,"
                    . " observation as observation, "
                    . " mntht as totalhax, "
                    . "  mntthtva as totalhtva ,"
                    . "  tva.libelle as tva ,"
                    . "  tva.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " tauxfodec.id as idtaufodec,tauxfodec.libelle as taufodec , "
                    . " prixu as puht,"
                    . "id_projet as idprojet, CONCAT('', '') as projet,"
                    . " lignecontrat.qte as qte "
                    . " from lignecontrat,projet,tva,unitemarche,tauxfodec"
                    . " where lignecontrat.id_projet IS NULL "
                    . " and lignecontrat.id_unite=unitemarche.id "
                    . " and lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " and lignecontrat.id_contrat=" . $id_Contrat
                    . " and lignecontrat.id_tva=tva.id "
                    . " )"
                    . " order by id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            // die($query);
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

}
