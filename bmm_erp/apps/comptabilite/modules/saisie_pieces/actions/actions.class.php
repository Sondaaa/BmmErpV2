<?php

/**
 * saisie_pieces actions.
 *
 * @package    sw-commerciale
 * @subpackage saisie_pieces
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class saisie_piecesActions extends sfActions {

    /**
     * 
     * @param sfRequest $request A request object
     */
    public function executeJournalParCode(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $numero = $params['numero'];
            if ($numero) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT journalcomptable.id as id ,"
                        . "concat( TRIM(journalcomptable.code),' - ' ,journalcomptable.libelle) as name,"
                        . " typejournal.id as type_journal"
                        . " FROM journalcomptable,typejournal"
                        . " WHERE (Upper(journalcomptable.code) LIKE '" . strtoupper($numero) . "%'"
                        . " or Upper(journalcomptable.libelle) LIKE '" . strtoupper($numero) . "%')"
                        . " and journalcomptable.id_type_journal=typejournal.id"
                        . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                        . " and journalcomptable.id_exercice=" . $_SESSION['exercice_id']
                        . " ORDER BY journalcomptable.code";
                $comptes = $conn->fetchAssoc($query);

                die(json_encode($comptes));
            } else {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT journalcomptable.id as id ,"
                        . "concat( TRIM(journalcomptable.code),' - ' ,journalcomptable.libelle) as name,"
                        . " typejournal.id as type_journal"
                        . " FROM journalcomptable,typejournal"
                        . " WHERE journalcomptable.id_type_journal=typejournal.id"
                        . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                        . " and journalcomptable.id_exercice=" . $_SESSION['exercice_id']
                        . " ORDER BY journalcomptable.code";
                $comptes = $conn->fetchAssoc($query);

                die(json_encode($comptes));
            }
        }
        die('Erreur');
    }

    public function executeAfficherJournal(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_journal = $params['id_journal'];
            if ($id_journal) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT journalcomptable.id as id ,"
                        . "concat( TRIM(journalcomptable.code),' - ' ,journalcomptable.libelle) as name"
                        . " FROM journalcomptable"
                        . " WHERE journalcomptable.id=" . $id_journal
                        . " ORDER BY journalcomptable.code";
                $comptes = $conn->fetchAssoc($query);
                die(json_encode($comptes));
            }
        }
        die('Erreur');
    }

    public function executeAfficherLibelleMaquette(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $maquette_id = $params['maquette_id'];
            if ($maquette_id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT maquette.id as id ,"
                        . " maquette.libelle as name"
                        . " FROM maquette"
                        . " WHERE maquette.id=" . $maquette_id;
                $comptes = $conn->fetchAssoc($query);
                //  die(json_encode($comptes));
                $this->getResponse()->setContentType('text/json');

                return $this->renderText(json_encode(array(
                            'data' => $comptes
                )));
            }
        }
        die('Erreur');
    }

//    public function executeAffichernumeroexterne(sfWebRequest $request)
//    {
//
//        header('Access-Control-Allow-Origin: *');
//        $content = $request->getContent();
//
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//
//            $id_journal = $params['id_journal'];
//
//            if ($id_journal) {
//                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//                $query = "SELECT CAST(lignepiececomptable.numeroexterne  AS int) + 1 as numero_externe"
//                    . " FROM journalcomptable,lignepiececomptable,piececomptable "
//                    . " WHERE piececomptable.id_journalcomptable=" . $id_journal
//                    . " and piececomptable.id=lignepiececomptable.id_piececomptable"
//                    . " and journalcomptable.id=piececomptable.id_journalcomptable"
//                    . " and lignepiececomptable.numeroexterne is not null "
//                    . " and lignepiececomptable.numeroexterne != ''"
//                    . " and piececomptable.id_exercice=" . $_SESSION['exercice_id']
//                    . " and  journalcomptable.id=" . $id_journal
//                    . " ORDER BY CAST(lignepiececomptable.numeroexterne AS int) desc "
//                    . 'limit 1';
//                $comptes = $conn->fetchAssoc($query);
//                //die($query);
//                die(json_encode($comptes));
//            }
//        }
//        die('Erreur');
//    }

    public function executeAfficherNaturePiece(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id_naturepiece = $params['id_naturepiece'];
            if ($id_naturepiece) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT naturepiece.id as id ,"
                        . " TRIM(naturepiece.libelle) as name"
                        . " FROM naturepiece "
                        . " WHERE naturepiece.id=" . $id_naturepiece
                        . " ORDER BY naturepiece.id";
                $comptes = $conn->fetchAssoc($query);

                die(json_encode($comptes));
            }
        }
        die('Erreur');
    }

    public function executeJournalParCodeEdit(sfWebRequest $request) {
        $numero = $request->getParameter('numero', '');
        if ($numero) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT journalcomptable.id as id ,"
                    . "concat( TRIM(journalcomptable.code),' - ' ,TRIM(journalcomptable.libelle)) as name,"
                    . " typejournal.id as type_journal"
                    . " FROM journalcomptable,typejournal"
                    . " WHERE Upper(journalcomptable.code) LIKE '" . strtoupper($numero) . "%'"
                    . " and journalcomptable.id_type_journal=typejournal.id"
                    . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                    . " and journalcomptable.id_exercice=" . $_SESSION['exercice_id']
                    . " ORDER BY journalcomptable.code";
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        } else {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT journalcomptable.id as id ,"
                    . "concat( TRIM(journalcomptable.code),' - ' ,journalcomptable.libelle) as name,"
                    . " typejournal.id as type_journal"
                    . " FROM journalcomptable,typejournal"
                    . " WHERE journalcomptable.id_type_journal=typejournal.id"
                    . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                    . " and journalcomptable.id_exercice=" . $_SESSION['exercice_id']
                    . " ORDER BY journalcomptable.code";
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        }
    }

    public function executeNaturePieceParCode(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT naturepiece.id as id ,"
                    . " TRIM(naturepiece.libelle) as name"
                    . " FROM naturepiece "
                    . " WHERE Upper(naturepiece.libelle) LIKE '%" . strtoupper($numero) . "%'"
                    //                        ." and lignepiececomptable.id_naturepiece=naturepiece.id"
                    //                        ." and lignepiececomptable.id_piececomptable=piececomptable.id"
                    //                        . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                    //                        . " and piececomptable.id_exercice=" . $_SESSION['exercice_id']
                    . " ORDER BY naturepiece.libelle";
            //            die($query);
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        }
        die('Erreur');
    }

    public function executeNaturePieceParCodeEdit(sfWebRequest $request) {

        $numero = $request->getParameter('numero', '');
        //        if ($numero) {
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT naturepiece.id as id ,"
                . " TRIM(naturepiece.libelle) as name"
                . " FROM naturepiece "
                . " WHERE Upper(naturepiece.libelle) LIKE '" . strtoupper($numero) . "%'"
                //                        ." and lignepiececomptable.id_naturepiece=naturepiece.id"
                //                        ." and lignepiececomptable.id_piececomptable=piececomptable.id"
                //                        . " and journalcomptable.id_dossier=" . $_SESSION['dossier_id']
                //                        . " and piececomptable.id_exercice=" . $_SESSION['exercice_id']
                . " ORDER BY naturepiece.libelle";
        $comptes = $conn->fetchAssoc($query);

        die(json_encode($comptes));
        //        }
        //        }die('Erreur');
    }

    public function executeAfficherEtatJournalSeul(sfWebRequest $request) {
        $journal_id = $request->getParameter('journal_id', '');
        $date_debut = $_SESSION['exercice'] . '-01-01';
        $date_fin = $_SESSION['exercice'] . '-12-31';
        $journal = JournalcomptableTable::getInstance()->find($journal_id);
        $etatJournal = LignepiececomptableTable::getInstance()->loadEtatJournalSeulFormsaisie($journal_id, $date_debut, $date_fin);
        return $this->renderPartial("piece_par_journal", array("etatJournal" => $etatJournal, "journal" => $journal, "date_debut" => $date_debut, "date_fin" => $date_fin));
    }

    public function executeAffichersolde(sfWebRequest $request) {



        $id_compte = $request->getParameter('id_compte');

        if ($id_compte != '') {
            $compte = PlandossiercomptableTable::getInstance()->findOneById($id_compte);

            $tab = array();
            $tab['numerocompte'] = trim($compte->getNumerocompte()) . '-' . $compte->getLibelle();
            $tab['solde'] = $compte->getSolde();
            $tab['soldeouv'] = $compte->getSolde();
            $tab['typesolde'] = $compte->getTypesolde();
            return $this->renderText(json_encode($tab));
        }
        die("Erreur");
    }

    public function executeAffichersolde2(sfWebRequest $request) {
        $finalBalance = array();
        $date_debut = $_SESSION['exercice'] . '-01-01';
        $date_fin = $_SESSION['exercice'] . '-12-31';
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $id_compte = $request->getParameter('id_compte');

        if ($id_compte != '') {
            $compte = PlandossiercomptableTable::getInstance()->findOneById($id_compte);
            //             foreach ($compte as $compte) {
            $ligne = LignepiececomptableTable::getInstance()->findByIdComptecomptable($compte->getId());
            if ($ligne->count() != 0) {
                if ($compte->getLignepiececomptable()->count() != 0) {
                    $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($compte->getNumerocompte()), $date_debut, $date_fin, $exercice_id, $dossier_id);
                    $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($compte->getNumerocompte()));
                    //die($calcul_mois_ouv->getTotalDebit() .'credit='.$calcul_mois_ouv->getTotalCredit());
                    if (strlen(trim($compte->getPlancomptable()->getNumerocompte())) > 7) {
                        $soldeDebit = $calcul_mois_ouv->getTotalDebit() + $calcul_mois->getTotalDebit();
                        $soldeCredit = $calcul_mois_ouv->getTotalCredit() + $calcul_mois->getTotalCredit();

                        if ($soldeDebit < $soldeCredit) {
                            $soldeCredit = $soldeCredit - $soldeDebit;
                        } else {
                            $soldeDebit = $soldeDebit - $soldeCredit;
                        }
                    }
                }
            }
            $final_balance = array();
            $final_balance['id'] = $compte->getId();
            $final_balance['numerocompte'] = trim($compte->getNumerocompte()) . '-' . $compte->getLibelle();
            $final_balance['libelle'] = trim($compte->getLibelle());

            $final_balance['debitMois'] = $calcul_mois->getTotalDebit();
            $final_balance['creditMois'] = $calcul_mois->getTotalCredit();
            $final_balance['debitOuv'] = $calcul_mois_ouv->getTotalDebit();
            $final_balance['creditOuv'] = $calcul_mois_ouv->getTotalCredit();

            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0) {
                $final_balance['crediteur'] = $soldeCredit;
                $final_balance['debiteur'] = 0;
            } else {
                $final_balance['debiteur'] = $soldeDebit;
                $final_balance['crediteur'] = 0;
            }




            array_push($finalBalance, $final_balance);
            //             }
            return $this->renderText(json_encode($final_balance));
            ;
            //            $tab = array();
            //            $tab['numerocompte'] = trim($compte->getNumerocompte()) . '-' . $compte->getLibelle();
            //            $tab['solde'] = $compte->getSolde();
            //            $tab['soldeouv'] = $compte->getSolde();
            //            $tab['typesolde'] = $compte->getTypesolde();
            //            return $this->renderText(json_encode($tab));
        }
        die("Erreur");
    }

    public function executeIndex(sfWebRequest $request) {
        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']);
        $pager = new sfDoctrinePager('Maquette', 5);
        $this->page = $request->getParameter('page', 1);
        $pager->setQuery(MaquetteTable::getInstance()->loadAllFiltre('', '', '', '', '', '', '', ''));
        $pager->setPage($this->page);
        $pager->init();
        $this->pager = $pager;
        $this->maquettes = MaquetteTable::getInstance()->findAll();
    }

    public function executeShowEdit(sfWebRequest $request) {
        $this->piece = PiececomptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeNouveauSaisiePieces(sfWebRequest $request) {
        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']);
        $pager = new sfDoctrinePager('Maquette', 5);
        $this->page = $request->getParameter('page', 1);
        $pager->setQuery(MaquetteTable::getInstance()->loadAllFiltre('', '', '', '', '', '', '', ''));
        $pager->setPage($this->page);
        $pager->init();
        $this->pager = $pager;
        $this->maquettes = MaquetteTable::getInstance()->findAll();
    }

    public function executeCompteparnumero(sfWebRequest $request) {
        $numero = $request->getParameter('numero');
        //        $journal_id = $request->getParameter('journal_id');
        if ($numero) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            //            $query = "SELECT plandossiercomptable.id as id , concat(TRIM(plandossiercomptable.numerocompte) ,' - ',TRIM(plandossiercomptable.libelle)) as name"
            //                    . " FROM plandossiercomptable, plancomptable, souscomptejournal"
            //                    . " WHERE plancomptable.numerocompte LIKE '" . $numero . "%'"
            //                    . " AND plandossiercomptable.id_plan = plancomptable.id"
            //                    . " AND plancomptable.id = souscomptejournal.id_souscompte"
            //                    . " AND souscomptejournal.id_journal = " . $journal_id
            //                    . " ORDER BY plancomptable.numerocompte";
            //            $comptes = $conn->fetchAssoc($query);
            //            if ($comptes->count() != 0) {
            $query = "SELECT plandossiercomptable.id as id , concat(TRIM(plandossiercomptable.numerocompte) ,' - ',TRIM(plandossiercomptable.libelle)) as name, TRIM(plandossiercomptable.numerocompte) as numero"
                    . " FROM plandossiercomptable"
                    . " WHERE plandossiercomptable.numerocompte LIKE '" . $numero . "%'"
                    . " AND plandossiercomptable.id_exercice = " . $_SESSION['exercice_id']
                    . " AND plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                    . " AND LENGTH(trim(plandossiercomptable.numerocompte))>=7"
                    . " ORDER BY plandossiercomptable.numerocompte";
            $comptes = $conn->fetchAssoc($query);
            //            }

            die(json_encode($comptes));
        }
    }

    public function executeCompteparnumeroMaxChiffre(sfWebRequest $request) {
        //        $numero = $request->getParameter('numero');
        $numero = strtoupper($request->getParameter('numero'));
        //        $libelle = $request->getParameter('libelle');
        if ($numero) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT plandossiercomptable.id as id , concat(TRIM(plandossiercomptable.numerocompte) ,' - ',TRIM(plandossiercomptable.libelle)) as name, TRIM(plandossiercomptable.numerocompte) as numero"
                    . " FROM plandossiercomptable"
                    . " WHERE (concat(plandossiercomptable.numerocompte, UPPER( plandossiercomptable.libelle)) LIKE '%" . $numero . "%'"
                    . " or  plandossiercomptable.numerocompte LIKE '" . $numero . "%' )"
                    . " AND plandossiercomptable.id_exercice = " . $_SESSION['exercice_id']
                    . " AND plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                    . " AND LENGTH(trim(plandossiercomptable.numerocompte)) >= 7"
                    . " ORDER BY plandossiercomptable.numerocompte";
            $comptes = $conn->fetchAssoc($query);
            die(json_encode($comptes));
        }
    }

    public function executeAfficherpiececomptable(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_journal = $params['id_journal'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT piececomptable.id as id , piececomptable.numero as libelle"
                    . " From piececomptable , journalcomptable "
                    . "where piececomptable.id_journalcomptable = journalcomptable.id"
                    . " and  journalcomptable.id=" . $id_journal
                    . " and piececomptable.id_exercice=" . $_SESSION['exercice_id']
                    . " order by id asc";
            //           die($query);
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        }
        die("Erreur");
    }

    public function executeValiderPiece(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle');
        $numeroExterne = $request->getParameter('numero_externe');
        //        die($numeroExterne.'num_externe');
        $reference_piece = $request->getParameter('reference');
        $naturePiece = $request->getParameter('nature_piece');
        $this->reference = '';
        $this->num_externe = '';
        $this->libelle = '';
        //        $this->id_nature_pieces = '';
        $journal = $request->getParameter('journal');

        $date = $request->getParameter('date');
        $serie = $request->getParameter('serie');
        $numero = $request->getParameter('numero');

        $libelle_piece = $request->getParameter('libelle_piece');
        $total_debit = $request->getParameter('total_debit');
        $total_credit = $request->getParameter('total_credit');
        $piece_id = $request->getParameter('piece_id');
        $re_journal = $request->getParameter('re_journal');
        $numero_compte = $request->getParameter('numero_compte');

        $lettre_compte = $request->getParameter('lettre_compte');
        $ligne_contre = $request->getParameter('ligne_contre');
        $ligne_debit = $request->getParameter('ligne_debit');
        $ligne_credit = $request->getParameter('ligne_credit');
        $ligne_nature_id = $request->getParameter('ligne_nature_id');
        //        $ligne_numero_externe = $request->getParameter('ligne_numero_externe');

        $ligne_numero_externe = $request->getParameter('numero_externe');
        $ligne_reference = $request->getParameter('ligne_reference');
        $ligne_facture_id = $request->getParameter('ligne_facture_id');
        $ligne_libelle = $request->getParameter('ligne_libelle');
        $journal_comptable = JournalcomptableTable::getInstance()->findOneById($journal);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        if ($piece_id != '') {
            $piece = PiececomptableTable::getInstance()->find($piece_id);
            if ($piece == null)
                $piece = new Piececomptable();
            else {
                $ligne_pieces = LignepiececomptableTable::getInstance()->findByIdPiececomptable($piece_id);

                foreach ($ligne_pieces as $l_p) {
                    //                    $id_compte = $l_p->getIdComptecomptable();
                    //                    $lettre = $l_p->getLettrelettrage();
                    //                    $lettre_array = [$id_compte, ',,', $lettre];
                    $l_p->delete();
                }
                //                die(json_decode($lettre_array));
            }
        } else
            $piece = new Piececomptable();

        $user = $this->getUser()->getAttribute('userB2m');
        //        if ($piece_id == '') {
        $piece->setIdJournalcomptable($journal);
        $piece->setDate($date);
        $piece->setDatecreation(date('Y-m-d'));
        $piece->setIdUser($user->getId());
        $piece->setNumero($numero);
        $piece->setIdSerie($serie);
        //        }
        $piece->setTotaldebit($total_debit);
        $piece->setTotalcredit($total_credit);
        $piece->setLibelle($libelle_piece);

        $piece->setIdExercice($exercice_id);

        $piece->save();

        if ($piece_id == '')
            $piece_id = $piece->getId();

        $piece = PiececomptableTable::getInstance()->find($piece_id);
        $this->updateAttenduLastNumber($serie, $numero);

        $numero_compte = explode(',,', $numero_compte);
        $ligne_contre = explode(',,', $ligne_contre);

        $lettre_compte = explode(',,', $lettre_compte);
        $ligne_debit = explode(',,', $ligne_debit);
        $ligne_credit = explode(',,', $ligne_credit);
        $ligne_nature_id = explode(',,', $ligne_nature_id);
        $ligne_numero_externe = explode(',,', $ligne_numero_externe);
        $ligne_reference = explode(',,', $ligne_reference);
        $ligne_facture_id = explode(',,', $ligne_facture_id);
        $ligne_libelle = explode(',**,', $ligne_libelle);

        for ($i = 0; $i < sizeof($numero_compte); $i++) {
            //die('letttre'.$lettre_compte[$i]);
            if ($numero_compte[$i] != '') {
                $ligne_piece = new Lignepiececomptable();

                if ($numero_compte[$i] != '' && $numero_compte[$i] != '-1') {
                    //                    die($numero_compte[$i]);    
                    $plandossier = PlandossiercomptableTable::getInstance()->findOneById($numero_compte[$i]);
                    //                    if(!$plandossier)
                    //                        die($numero_compte[$i].'----');
                    $ligne_piece->setIdComptecomptable($numero_compte[$i]);
                    //                    if ($id_compte > 0) {
                    //
                    //                        $ligne_piece->setIdComptecomptable($id_compte[$i]);
                    //                    } else {
                    //                        $ligne_piece->setIdComptecomptable($numero_compte[$i]);
                    //                    }
                }
                if ($ligne_contre[$i] != '' && $ligne_contre[$i] != '-1')
                    $ligne_piece->setIdContrepartie($ligne_contre[$i]);
                $ligne_piece->setDate(date('Y-m-d'));

                if ($journal_comptable->getIdTypeJournal() == 1) {
                    if ($ligne_nature_id[$i] != '')
                        if ($ligne_nature_id[$i] == '7')
                            if ($ligne_facture_id[$i] != '' && $ligne_facture_id[$i] != '-1' && $ligne_facture_id != 'undefined')
                                $ligne_piece->setIdFacturevente($ligne_facture_id[$i]);
                } else if ($journal_comptable->getIdTypeJournal() == 2) {
                    if ($ligne_nature_id[$i] != '')
                        if ($ligne_nature_id[$i] == '7')
                            if ($ligne_facture_id[$i] != '' && $ligne_facture_id[$i] != '-1' && $ligne_facture_id != 'undefined')
                                $ligne_piece->setIdFactureachat($ligne_facture_id[$i]);
                }
                if ($lettre_compte[$i] != '' && $lettre_compte[$i] != 'undefined')
                    $ligne_piece->setLettrelettrage($lettre_compte[$i]);

                if ($ligne_credit[$i] != '')
                    $ligne_piece->setMontantcredit($ligne_credit[$i]);
                if ($ligne_debit[$i] != '')
                    $ligne_piece->setMontantdebit($ligne_debit[$i]);
                if ($naturePiece != '')
                    $ligne_piece->setIdNaturepiece($naturePiece);
                $ligne_piece->setNumeroexterne($numeroExterne);
                $ligne_piece->setIdPiececomptable($piece_id);
                $ligne_piece->setReference($ligne_reference[$i]);
                $ligne_piece->setLibelle($ligne_libelle[$i]);
                $ligne_piece->save();
                /* mis ajour des soles plan dossier comptable */
                //                $plan_dossier = PlandossiercomptableTable::getInstance()->findOneById($numero_compte[$i]);
                $plan_dossier = PlandossiercomptableTable::getInstance()->getbyNumAndNotInClass6and7($numero_compte[$i])->getFirst();
                //               die($numero_compte[$i].'size'.sizeof($plan_dossier));
                if ($plan_dossier) {
                    $solde_ancie = $plan_dossier->getSolde();
                    $solde_nv = $solde_ancie + $ligne_debit[$i] - $ligne_credit[$i];
                    $plan_dossier->setSolde($solde_nv);
                    $plan_dossier->save();
                }
            }
        }

        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);

        if ($re_journal == 1) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT CAST(lignepiececomptable.numeroexterne  AS int) + 1 as numero_externe"
                    . " FROM journalcomptable,lignepiececomptable,piececomptable "
                    . " WHERE piececomptable.id_journalcomptable=" . $journal
                    . " and piececomptable.id=lignepiececomptable.id_piececomptable"
                    . " and journalcomptable.id=piececomptable.id_journalcomptable"
                    . " and lignepiececomptable.numeroexterne is not null "
                    . " and lignepiececomptable.numeroexterne != ''"
                    . " and piececomptable.id_exercice=" . $_SESSION['exercice_id']
                    . " and  journalcomptable.id=" . $journal
                    . " ORDER BY CAST(lignepiececomptable.numeroexterne AS int) desc "
                    . 'limit 1';
            //            die($query);
            $comptes = $conn->fetchAssoc($query);

            //            $compte_json = json_encode($comptes);
            //            die($comptes[0]['numero_externe'].'mp');
            $numero_externe_nouvau = $comptes[0]['numero_externe'];
            //            die($numero_externe_nouvau . 'nv_extrene');
            //            die('lib'.$libelle.' '.$numeroExterne.'   '.$reference_piece.'  '.$naturePiece);
            $this->id_journal = $journal;
            $this->id_serie = $serie;
            $this->date = $date;
            $serie_journal = NumeroseriejournalTable::getInstance()->getSerie($journal, $date)->getFirst();
            $this->serie = $serie_journal->getPrefixe();
            $this->numero = str_replace(' ', '', $serie_journal->getPrefixe()) . sprintf("%03s", $serie_journal->getAttendu());
            $this->reference = $reference_piece;
            $this->num_externe = $numero_externe_nouvau;
            $this->libelle = $libelle;
            $this->id_nature_pieces = $naturePiece;
        } else {
            $this->id_journal = '';
            $this->id_serie = '';
            $this->date = '';
            $this->serie = '';
            $this->numero = '';
            $this->num_externe = '';
            $this->id_nature_pieces = '';
        }

        $pager = new sfDoctrinePager('Maquette', 5);
        $this->page = $request->getParameter('page', 1);
        $pager->setQuery(MaquetteTable::getInstance()->loadAllFiltre('', '', '', '', '', '', '', ''));
        $pager->setPage($this->page);
        $pager->init();
        $this->pager = $pager;
        $this->maquettes = MaquetteTable::getInstance()->findAll();
    }

    public function updateAttenduLastNumber($serie_id, $numero) {
        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie_id);
        $numero_courant = trim($numero_serie->getPrefixe()) . sprintf("%03s", $numero_serie->getAttendu());

        if ($numero_courant == $numero) {
            $attendu = $numero_serie->getNumerofin() + 1;
            if ($numero_serie->getPiececomptable()->count() != 1) {

                if ($numero_serie->getNumerofin() <= $numero_serie->getAttendu() && $numero_serie->getAttendu() != 1) {
                    $numero_serie->setNumerofin($numero_serie->getAttendu());
                    $numero_serie->save();
                }
            }

            $attendu = $numero_serie->getAttendu();
            //test si attendu existe ou non
            $test_numero = trim($numero_serie->getPrefixe()) . sprintf("%03s", $attendu);
            $pieces = PiececomptableTable::getInstance()->findByNumero($test_numero);
            if ($pieces->count() == 0) {
                $numero_serie->setAttendu($attendu);
                $numero_serie->save();
            } else {
                $attendu = $attendu + 1;
                $this->updateAttendu($serie_id, $attendu);
            }
        } else {
            $taille_numero = strlen($numero) - 4;
            $numero_fin = substr($numero, 4, $taille_numero);
            if ($numero_serie->getNumerofin() < intval($numero_fin)) {
                $numero_serie->setNumerofin($numero_fin);
                $numero_serie->save();
            }
        }
    }

    public function updateAttendu($serie_id, $attendu) {
        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie_id);
        $test_numero = trim($numero_serie->getPrefixe()) . sprintf("%03s", $attendu);

        $pieces = PiececomptableTable::getInstance()->getByNumero($test_numero);

        //        if ($pieces->count() == 0) {
        $numero_serie->setAttendu($attendu);
        $numero_serie->save();
        //        } else {
        //            $attendu = $attendu + 1;
        //            //appel recursif
        //            $this->updateAttendu($serie_id, $attendu);
        //        }
        //         die($numero_serie->getId().'id'.$numero_serie->getAttendu().'atte'.$pieces->count());
    }

    public function executeAddLigne(sfWebRequest $request) {
        $this->numero_ligne = 0;
        $this->selectedcontre = '';
        $this->nature_piece = '';
        $contre_partie = '';
        $maquette_id = $request->getParameter('maquette_id');
        $this->maquette = null;
        $this->numero_externe = $request->getParameter('numero_externe');
        $type_journal_id = $request->getParameter('type_journal_id');
        $nature_id = $request->getParameter('nature_id');
        $reference = $request->getParameter('reference');
        $journal_id = $request->getParameter('journal_id');

        $libelle_ligne = $request->getParameter('libelle_ligne');

        if ($nature_id == '')
            $nature_id = 7;
        $journal = JournalcomptableTable::getInstance()->find($journal_id);

        if ($request->getParameter('numerofinligne'))
            $this->numero_ligne = $request->getParameter('numerofinligne');
        if ($request->getParameter('selectedcontre'))
            $this->selectedcontre = $request->getParameter('selectedcontre');
        $this->reference = $reference;


        //           $this->nature_piece = NaturepieceTable::getInstance()->find($nature_id);
        //        $comptes = PlandossiercomptableTable::getInstance()->findByJournalOrderByNumero($journal_id);
        //        if ($comptes->count() != 0)
        //            $this->comptes = $comptes;
        //        else
        //            $this->comptes = PlandossiercomptableTable::getInstance()->findOrderByNumero();
        $this->facture = null;
        if ($type_journal_id == 1 && $nature_id == 7) {
            $this->facture = FacturecomptableventeTable::getInstance()->findOneByReference($reference);
            $this->type = 'vente';
        }
        if ($type_journal_id == 2 && $nature_id == 7) {
            $this->facture = FacturecomptableachatTable::getInstance()->findOneByReference($reference);
            $this->type = 'achat';
        }

        $this->selected_compte = $request->getParameter('selected_compte');
        //        die($request->getParameter('selected_compte'));
        $this->credit = $request->getParameter('credit', '');
        $this->debit = $request->getParameter('debit', '');
        if ($journal->getIdComptecontrepartie()) {
            $plan = PlancomptableTable::getInstance()->findOneById($journal->getIdComptecontrepartie());
            $numero = $plan->getNumerocompte();
            $contre_partie = $journal->getIdComptecontrepartie();
            $this->selected_contre = $contre_partie;
            $this->selectedcontre = $contre_partie;
        }
        if ($maquette_id && $maquette_id != '')
            $this->maquette = MaquetteTable::getInstance()->find($maquette_id);
        $this->libelle_ligne = $libelle_ligne;
    }

    public function executeInsertLigne(sfWebRequest $request) {
        $journal_id = $request->getParameter('journal');
        $comptes = PlanComptableTable::getInstance()->findByJournalOrderByNumero($journal_id);
        if ($comptes->count() != 0)
            $this->comptes = $comptes;
        else
            $this->comptes = PlanComptableTable::getInstance()->findOrderByNumero();
    }

    public function executeGetSerieJournal(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $date = $request->getParameter('date');
        $serie = NumeroseriejournalTable::getInstance()->getSerie($journal, $date)->getFirst();

        $tab = array();
        $tab['serie'] = $serie->getPrefixe();
        $tab['valide'] = $serie->getIsvalide();
        $tab['bloque'] = $serie->getIsbloque();
        $tab['serie_id'] = $serie->getId();
        $tab['numero'] = str_replace(' ', '', $serie->getPrefixe()) . sprintf("%03s", $serie->getAttendu());
        $tab['attendu'] = sprintf("%03s", $serie->getAttendu());
        //        die($serie->getAttendu().'fr'.$journal.'m');
        return $this->renderText(json_encode($tab));
    }

    public function executeGetPieceJournal(sfWebRequest $request) {
        $numero = $request->getParameter('numero');
        $journal_id = $request->getParameter('journal');
        $this->piece = PiececomptableTable::getInstance()->findOneByNumeroAndIdJournalcomptable($numero, $journal_id);
    }

    public function executeSupprimer(sfWebRequest $request) {
        $this->supprimerPiece($request);
        $this->nature_pieces = NaturePieceTable::getInstance()->findAll();
        $this->journals = JournalcomptableTable::getInstance()->findAll();
    }

    public function supprimerPiece(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $nblettre = 0;
        $piece = PieceComptableTable::getInstance()->find($id);
        $serie = NumeroSerieJournalTable::getInstance()->find($piece->getIdSerie());
        $attendu = $serie->getAttendu();
        $prefixe = $serie->getPrefixe();
        $numero = $piece->getNumero();
        $numero_sans_prefixe = str_replace($prefixe, "", $numero);
        if (intval($numero_sans_prefixe) < $attendu) {
            $serie->setAttendu(($numero_sans_prefixe));
            $serie->save();
        }
        //        $dossier_comptable = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $type = "";
        $id_facture_importe = "";
        if (sizeof($piece->getLignepiececomptable()) >= 1) {
            foreach ($piece->getLignepiececomptable() as $l_p) {
                if ($l_p->getLettrelettrage())
                    $nblettre++;
            }
        }
        if ($nblettre == 0):
            if (sizeof($piece->getLignepiececomptable()) >= 1) {
                foreach ($piece->getLignepiececomptable() as $l_p) {
                    //Mise à jour solde plan dossier comptable (solde du compte comptable associé au dossier & exercice)
                    $dossier_plan = PlandossiercomptableTable::getInstance()->findOneById($l_p->getIdComptecomptable());
                    //            die(($dossier_plan->getSolde()) . 'id');
                    $dossier_plan_solde = $dossier_plan->getSolde();
                    if ($l_p->getMontantdebit() != 0)
                        $dossier_plan_solde = $dossier_plan_solde - $l_p->getMontantdebit();
                    if ($l_p->getMontantcredit() != 0)
                        $dossier_plan_solde = $dossier_plan_solde + $l_p->getMontantcredit();
                    $dossier_plan->setSolde($dossier_plan_solde);
                    $dossier_plan->save();
                    //en cas de création par facture importée par l'excel
                    if ($l_p->getIdFactureachat()) {
                        $type = "achat";
                        $id_facture_importe = $l_p->getIdFactureachat();
                    }
                    if ($l_p->getIdFacturevente()) {
                        $type = "vente";
                        $id_facture_importe = $l_p->getIdFacturevente();
                    }
                    if ($l_p->getIdFactureod()) {
                        $type = "od";
                        $id_facture_importe = $l_p->getIdFactureod();
                    }
                    if ($l_p->getIdFactureodclient()) {
                        $type = "od_client";
                        $id_facture_importe = $l_p->getIdFactureodclient();
                    }
                    if ($l_p->getIdRegelment()) {
                        $type = "banque";
                        $id_facture_importe = $l_p->getIdRegelment();
                    }
                    if ($l_p->getIdMouvement()) {
                        $type = "od_mouvement";
                        $id_facture_importe = $l_p->getIdMouvement();
                    }
                    $l_p->delete();
                }
            } else {
                $facture_vente = FacturecomptableventeTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_vente) >= 1) {
                    $facture_vente->getFirst()->setIdPiececomptable(null);
                    $facture_vente->getFirst()->setSaisie(0);
                    $facture_vente->save();
                    $piece->delete();
                }

                $facture_achat = FacturecomptableachatTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_achat) >= 1) {
                    $facture_achat->getFirst()->setIdPiececomptable(null);
                    $facture_achat->getFirst()->setSaisie(0);
                    $facture_achat->save();
                    $piece->delete();
                }

                $facture_od = FacturecomptableodTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_od) >= 1) {
                    $facture_od->getFirst()->setIdPiececomptable(null);
                    $facture_od->getFirst()->setSaisie(0);
                    $facture_od->save();
                    $piece->delete();
                }

                $facture_od_client = FacturecomptableodclientTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_od_client) >= 1) {
                    $facture_od_client->getFirst()->setIdPiececomptable(null);
                    $facture_od_client->getFirst()->setSaisie(0);
                    $facture_od_client->save();
                    $piece->delete();
                }

                $reglement = ReglementcomptableTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($reglement) >= 1) {
                    $reglement->getFirst()->setIdPiececomptable(null);
                    $reglement->getFirst()->setSaisie(0);
                    $reglement->save();
                    $piece->delete();
                }

                $mouvement = MovementpieceTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($mouvement) >= 1) {
                    $mouvement->getFirst()->setIdPiececomptable(null);
                    $mouvement->getFirst()->setSaisie(0);
                    $mouvement->save();
                    $piece->delete();
                }
            }
            //Vérifier si la pièce est créée par une facture importée par l'excel
            switch ($type) {
                case "achat":
                    $facture_importe = FacturecomptableachatTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;

                case "vente":
                    $facture_importe = FacturecomptableventeTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;
                case "od":
                    $facture_importe = FacturecomptableodTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;
                case "od_client":
                    $facture_importe = FacturecomptableodclientTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;
                case "banque":
                    $facture_importe = ReglementcomptableTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;
                case "od_mouvement":
                    $facture_importe = MovementpieceTable::getInstance()->find($id_facture_importe);
                    $facture_importe->setSaisie(0);
                    $facture_importe->setIdPiececomptable(null);
                    $facture_importe->save();
                    break;
                default:

                    break;
            }
            $piece->delete();
        else:
            $piece->getId();
        endif;
    }

    public function executeGetPieceLigneVente(sfWebRequest $request) {
        $this->facture_vente = FacturecomptableventeTable::getInstance()->findOneByReference($request->getParameter('reference'));
    }

    public function executeGetPieceLigneBanque(sfWebRequest $request) {
        $this->reglement = ReglementcomptableTable::getInstance()->findOneByRefrence($request->getParameter('reference'));
    }

    public function executeGetPieceLigneOd(sfWebRequest $request) {
        $this->facture_od = ReglementcomptableTable::getInstance()->findOneByReference($request->getParameter('reference'));
    }

    public function executeGetPieceLigneAchat(sfWebRequest $request) {
        $this->facture_achat = FacturecomptableachatTable::getInstance()->findOneByReference($request->getParameter('reference'));
    }

    //    public function executeVerifierNumeroExterne(sfWebRequest $request) {
    //        $numero_externe = $request->getParameter('numero_externe');
    //
    //        $journal_id = $request->getParameter('journal_id');
    //        $this->numero_externe = $numero_externe;
    //        $lignes = LignepiececomptableTable::getInstance()->getExistanceNumexeterne($numero_externe, $journal_id);
    //        $this->lignes = $lignes;
    //        return $lignes;
    //    }

    public function executeTestexistanceNumeroexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_journal = $params['id_journal'];
            $numero_externe = $params['numero_externe'];
            $serie_id = $params['serie_id'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT lignepiececomptable.id as id_ligne, lignepiececomptable.numeroexterne as code"
                    . ", piececomptable.id as id "
                    . " FROM piececomptable ,lignepiececomptable,journalcomptable "
                    . " WHERE lignepiececomptable.numeroexterne ='" . $numero_externe . "'"
                    . " and journalcomptable.id=" . $id_journal
                    . "  and lignepiececomptable.id_piececomptable =piececomptable.id"
                    . " and piececomptable.id_journalcomptable =journalcomptable.id "
                    . " and piececomptable.id_serie = " . $serie_id
                    . " order by id asc";
            //die($query);
            $resultat = $conn->fetchAssoc($query);


            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeListePiece(sfWebRequest $request) {
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $statut = $request->getParameter('statut', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $pager = $this->paginate($request);
        $this->pager = $pager;

        $this->page = $request->getParameter('page', 1);
        $pieces = $pager;
        //        $pieces_comptable = PiececomptableTable::getInstance()->findAll();
        //        $pieces = PiececomptableTable::getInstance()->findAll();
        $this->pieces = $pieces;
        //        $this->pieces_comptable = $pieces_comptable;
        $this->journal = $journal;
        $this->num = $num;
        $this->statut = $statut;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->num_debut = $num_debut;
        $this->num_fin = $num_fin;
        $this->type_tri = $type_tri;
        $this->tri = $tri;
    }

    public function executeGoPage(sfWebRequest $request) {
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $num_externe = $request->getParameter('num_externe', '');
        $statut = $request->getParameter('statut', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $numero_min = $request->getParameter('numero_min', '');
        $numero_max = $request->getParameter('numero_max', '');



        $journal_comptable = $request->getParameter('journal_comptable', '');

        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("saisie_pieces/liste", array("pager" => $pager, "page" => $page, "journal" => $journal, "num" => $num, "num_externe" => $num_externe, "statut" => $statut, "date_debut" => $date_debut, "date_fin" => $date_fin, "num_debut" => $num_debut, "num_fin" => $num_fin, "type_tri" => $type_tri, "tri" => $tri, "numero_min" => $numero_min, "numero_max" => $numero_max));
    }

    public function executeDelete(sfWebRequest $request) {
        $this->supprimerPiece($request);

        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeAfficherListPiece(sfWebRequest $request) {
        $numero_min = $request->getParameter('numero_min', '');
        $numero_max = $request->getParameter('numero_max', '');
        $page = $request->getParameter('page', 1);
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PiececomptableTable::getInstance()->loadFiltre($numero_min, $numero_max));
        $pager->setPage($page);
        $pager->init();


        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $statut = $request->getParameter('statut', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        return $this->renderPartial("saisie_pieces/liste", array("pager" => $pager, "page" => $page, "journal" => $journal, "num" => $num, "statut" => $statut, "date_debut" => $date_debut, "date_fin" => $date_fin, "num_debut" => $num_debut, "num_fin" => $num_fin, "type_tri" => $type_tri, "tri" => $tri));
    }

    public function executeSupprimerPiececomptable(sfWebRequest $request) {
        $numero_min = $request->getParameter('numero_min', '');
        $numero_max = $request->getParameter('numero_max', '');
        $journal = $request->getParameter('journal', '');

        $num = $request->getParameter('num', '');
        $statut = $request->getParameter('statut', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $piece_intervalle = PiececomptableTable::getInstance()->loadByIntervalNumero($numero_min, $numero_max);
        $lignepiece_intervalle = LignepiececomptableTable::getInstance()->loadByIntervalNumero($numero_min, $numero_max);
        $i = 0;
        $type = "";
        $id_facture_importe = '';
        $facture_type = array();
        foreach ($piece_intervalle as $piece) {
            $serie = NumeroSerieJournalTable::getInstance()->find($piece->getIdSerie());
            $attendu = $serie->getAttendu();
            $prefixe = $serie->getPrefixe();
            $numero = $piece->getNumero();
            $numero_sans_prefixe = str_replace($prefixe, "", $numero);
            if (intval($numero_sans_prefixe) < $attendu) {
                $serie->setAttendu(($numero_sans_prefixe));
                $serie->save();
            }
            //            die(sizeof($piece->getLignepiececomptable()).'m');
            if (sizeof($piece->getLignepiececomptable()) >= 1) {
                foreach ($piece->getLignepiececomptable() as $ligne_i) {
                    //die($type.' '.$id_facture_importe);
                    $ligne = LignepiececomptableTable::getInstance()->findOneById($ligne_i->getId());
                    if ($ligne_i->getIdFactureachat()) {
                        $type = "achat";
                        $id_facture_importe = $ligne_i->getIdFactureachat();
                    }
                    if ($ligne_i->getIdFacturevente()) {
                        $type = "vente";
                        $id_facture_importe = $ligne_i->getIdFacturevente();
                    }
                    if ($ligne_i->getIdFactureod()) {
                        $type = "od";
                        $id_facture_importe = $ligne_i->getIdFactureod();
                    }
                    if ($ligne_i->getIdRegelment()) {
                        $type = "banque";
                        $id_facture_importe = $ligne_i->getIdRegelment();
                    }
                    if ($ligne_i->getIdFactureodclient()) {
                        $type = "od_client";
                        $id_facture_importe = $ligne_i->getIdFactureodclient();
                    }
                    if ($ligne_i->getIdMouvement()) {
                        $type = "od_mouvement";
                        $id_facture_importe = $ligne_i->getIdMouvement();
                    }

                    switch ($type) {
                        case "vente":
                            $facture_importe = FacturecomptableventeTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "achat":
                            $facture_importe = FacturecomptableachatTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "vente":
                            $facture_importe = FacturecomptableventeTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "od":
                            $facture_importe = FacturecomptableodTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "od_client":
                            $facture_importe = FacturecomptableodclientTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "banque":
                            $facture_importe = ReglementcomptableTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        case "od_mouvement":
                            $facture_importe = MovementpieceTable::getInstance()->find($id_facture_importe);
                            $facture_importe->setSaisie(0);
                            $facture_importe->setIdPiececomptable(null);
                            $facture_importe->save();
                            break;
                        default:

                            break;
                    }

                    $i = 0;
                    $ligne = LignepiececomptableTable::getInstance()->findOneById($ligne_i->getId());
                    $ligne->delete();
                }
                $piece->delete();
            } else {
                $facture_vente = FacturecomptableventeTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_vente) >= 1) {
                    $facture_vente->getFirst()->setIdPiececomptable(null);
                    $facture_vente->getFirst()->setSaisie(0);
                    $facture_vente->save();
                    $piece->delete();
                }

                $facture_achat = FacturecomptableachatTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_achat) >= 1) {
                    $facture_achat->getFirst()->setIdPiececomptable(null);
                    $facture_achat->getFirst()->setSaisie(0);
                    $facture_achat->save();
                    $piece->delete();
                }

                $facture_od = FacturecomptableodTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_od) >= 1) {
                    $facture_od->getFirst()->setIdPiececomptable(null);
                    $facture_od->getFirst()->setSaisie(0);
                    $facture_od->save();
                    $piece->delete();
                }

                $facture_od_client = FacturecomptableodclientTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($facture_od_client) >= 1) {
                    $facture_od_client->getFirst()->setIdPiececomptable(null);
                    $facture_od_client->getFirst()->setSaisie(0);
                    $facture_od_client->save();
                    $piece->delete();
                }

                $reglement = ReglementcomptableTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($reglement) >= 1) {
                    $reglement->getFirst()->setIdPiececomptable(null);
                    $reglement->getFirst()->setSaisie(0);
                    $reglement->save();
                    $piece->delete();
                }

                $mouvement = MovementpieceTable::getInstance()->getByIdPiece($piece->getId());
                if (sizeof($mouvement) >= 1) {
                    $mouvement->getFirst()->setIdPiececomptable(null);
                    $mouvement->getFirst()->setSaisie(0);
                    $mouvement->save();
                    $piece->delete();
                }
            }
        }
        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager = $this->paginate($request);
        $page = 1;
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial("saisie_pieces/liste", array("pager" => $pager, "page" => $page, "journal" => $journal, "num" => $num, "statut" => $statut, "date_debut" => $date_debut, "date_fin" => $date_fin, "num_debut" => $num_debut, "num_fin" => $num_fin, "type_tri" => $type_tri, "tri" => $tri));
    }

    public function executeShow(sfWebRequest $request) {
        $this->piece = PieceComptableTable::getInstance()->findOneById($request->getParameter('id'));
    }

    public function executeDetailRow(sfWebRequest $request) {
        $this->piece = PieceComptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = strtoupper($request->getParameter('journal', ''));
        $num = $request->getParameter('num', '');
        $num_externe = $request->getParameter('num_externe', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $numero_min = $request->getParameter('numero_min', '');
        $numero_max = $request->getParameter('numero_max', '');
        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $journal_comptable = $request->getParameter('journal_comptable', '');
        $exercice_id = $_SESSION['exercice_id'];

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltreByNumMinMax($journal, $num, $num_externe, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, $exercice_id, $numero_min, $numero_max, $journal_comptable));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeImprimeListe(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Pièce Comptable');
        $pdf->SetSubject("Pièce Comptable");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);

        $html = $this->ReadHtmlListePieceComptable($request);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Pièce Comptable.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListePieceComptable(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Piececomptable();
        $html .= $piece->ReadHtmlListePieceComptable($request);
        return $html;
    }

    public function executeImprimePiece(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Pièce Comptable');
        $pdf->SetSubject("Pièce Comptable");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage("L");
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlPieceComptable($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Pièce Comptable.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPieceComptable($id) {
        $html = StyleCssHeader::header1();
        $piece = new Piececomptable();
        $html .= $piece->ReadHtmlPieceComptable($id);
        return $html;
    }

    public function executeAlertPieceInvalide(sfWebRequest $request) {

        $export = FactureComptableVenteTable::getInstance()->findBySaisieAndEtranger(false, true)->count();
        $vente = FactureComptableVenteTable::getInstance()->findBySaisieAndEtranger(false, false)->count();
        $import = FactureComptableAchatTable::getInstance()->findBySaisieAndEtranger(false, true)->count();
        $achat = FactureComptableAchatTable::getInstance()->findBySaisieAndEtranger(false, false)->count();

        $tab = array();
        $tab['export'] = $export;
        $tab['vente'] = $vente;
        $tab['import'] = $import;
        $tab['achat'] = $achat;
        return $this->renderText(json_encode($tab));
    }

    public function executeListeAlertFactureAchat(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('ref', '');
        $dossier = $request->getParameter('dossier', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $etranger = 0;

        $this->pager = new sfDoctrinePager('FactureComptableAchat', 10);
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->pager->setQuery(FactureComptableAchatTable::getInstance()->loadAlert($ref, $dossier, $fournisseur, '', $etranger));
        else
            $this->pager->setQuery(FactureComptableAchatTable::getInstance()->loadAlert($ref, $dossier, $fournisseur, $this->getUser()->getId(), $etranger));
        $this->pager->setPage($page);
        $this->pager->init();
        $this->page = $page;

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeAlertFactureAchat", array("pager" => $this->pager, "page" => $this->page));
        }
    }

    public function executeListeAlertFactureImport(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('ref', '');
        $dossier = $request->getParameter('dossier', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $etranger = 1;

        $this->pager = new sfDoctrinePager('FactureComptableImport', 10);
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->pager->setQuery(FactureComptableAchatTable::getInstance()->loadAlert($ref, $dossier, $fournisseur, '', $etranger));
        else
            $this->pager->setQuery(FactureComptableAchatTable::getInstance()->loadAlert($ref, $dossier, $fournisseur, $this->getUser()->getId(), $etranger));
        $this->pager->setPage($page);
        $this->pager->init();
        $this->page = $page;

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeAlertFactureAchat", array("pager" => $this->pager, "page" => $this->page));
        }
    }

    public function executeListeAlertFactureVente(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('ref', '');
        $dossier = $request->getParameter('dossier', '');
        $client = $request->getParameter('client', '');
        $etranger = 0;

        $this->pager = new sfDoctrinePager('FactureComptableVente', 10);
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->pager->setQuery(FactureComptableVenteTable::getInstance()->loadAlert($ref, $dossier, $client, '', $etranger));
        else
            $this->pager->setQuery(FactureComptableVenteTable::getInstance()->loadAlert($ref, $dossier, $client, $this->getUser()->getId(), $etranger));
        $this->pager->setPage($page);
        $this->pager->init();
        $this->page = $page;

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeAlertFactureVente", array("pager" => $this->pager, "page" => $this->page));
        }
    }

    public function executeListeAlertFactureExport(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('ref', '');
        $dossier = $request->getParameter('dossier', '');
        $client = $request->getParameter('client', '');
        $etranger = 1;

        $this->pager = new sfDoctrinePager('FactureComptableExport', 10);
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->pager->setQuery(FactureComptableVenteTable::getInstance()->loadAlert($ref, $dossier, $client, '', $etranger));
        else
            $this->pager->setQuery(FactureComptableVenteTable::getInstance()->loadAlert($ref, $dossier, $client, $this->getUser()->getId(), $etranger));
        $this->pager->setPage($page);
        $this->pager->init();
        $this->page = $page;

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeAlertFactureVente", array("pager" => $this->pager, "page" => $this->page));
        }
    }

    public function executeShowMaquette(sfWebRequest $request) {
        $maquette_id = $request->getParameter('maquette_id');
        $this->maquette = MaquetteTable::getInstance()->find($maquette_id);
    }

}
