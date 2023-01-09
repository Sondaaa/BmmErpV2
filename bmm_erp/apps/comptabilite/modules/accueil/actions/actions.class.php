<?php

/**
 * Accueil actions.
 *
 * @package    Bmm
 * @subpackage Accueil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccueilActions extends sfActions
{

        /**
         * Executes index action
         *
         * @param sfRequest $request A request object
         */
        public function executeIndex(sfWebRequest $request)
        {
                //          $user = $this->getUser()->getAttribute('userB2m');
                //      die($user);
                //        if (!isset($_SESSION['exercice'])) {
                //            $_SESSION['exercice'] = null;
                //            $_SESSION['exercice_id'] = null;
                //            $_SESSION['dossier'] = null;
                //            $_SESSION['dossier_code'] = null;
                //            $_SESSION['dossier_id'] = null;
                //
                ////            $exercice_annee = ExerciceTable::getInstance()->getOneByLibelleAndType(date('Y'), 'comp');
                ////            if ($exercice_annee == null) {
                ////                $exercice_annee = new Exercice();
                ////                $exercice_annee->setLibelle(date('Y'));
                ////                $date_debut = date('Y') . '-01-01';
                ////                $exercice_annee->setDateDebut($date_debut);
                ////                $date_fin = date('Y') . '-12-31';
                ////                $exercice_annee->setDateFin($date_fin);
                ////                $exercice_annee->save();
                ////            }
                //        } else {

                $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
                //        }

                $user = new Utilisateur();
                $user = $this->getUser()->getAttribute('userB2m');

                if ($user->getProfil()->getId() != 1)
                        $this->dossiers = DossiercomptableTable::getInstance()->getDossierByUser($user->getId());
                else
                        $this->dossiers = DossiercomptableTable::getInstance()->getAllActive();

                $this->exercices = ExerciceTable::getInstance()->getAll('com');
        }

        /**
         * Executes index action
         *
         * @param sfRequest $request A request object
         */
        public function executeRetourdossier(sfWebRequest $request)
        {

                $_SESSION['exercice'] = null;
                $_SESSION['exercice_id'] = null;
                $_SESSION['dossier'] = null;
                $_SESSION['dossier_code'] = null;
                $_SESSION['dossier_id'] = null;

                return $this->redirect('@dossiervide');
        }

        public function executeValiderDossierCourant(sfWebRequest $request)
        {
                $dossier_id = $request->getParameter('dossier_id');
                $exercice_id = $request->getParameter('exercice_id');
                $dossier = DossiercomptableTable::getInstance()->find($dossier_id);

                $dossier_exercice = DossierExerciceTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id)->getFirst();
                if ($dossier_exercice == null) {
                        $dossier_exercice = new DossierExercice();
                        $dossier_exercice->setIdDossier($dossier_id);
                        $dossier_exercice->setIdExercice($exercice_id);
                        $dossier_exercice->setDate(date('Y-m-d'));
                        $dossier_exercice->save();
                }

                $dossier->setIdExercice($exercice_id);
                $dossier->save();

                $exercice = ExerciceTable::getInstance()->find($exercice_id);
                $_SESSION['exercice'] = $exercice->getLibelle();
                $_SESSION['exercice_id'] = $exercice_id;
                $_SESSION['dossier'] = trim($dossier->getRaisonsociale());
                $_SESSION['dossier_code'] = trim($dossier->getCode());
                $_SESSION['dossier_id'] = $dossier_id;

                die("ok");
        }

        public function executeValiderJournauxComptable(sfWebRequest $request)
        {
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();

                //Valider Tous les journaux comptables de l'exercice courant
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "UPDATE journalcomptable "
                        . "SET iscloture= 1, isbloque = 1, isvalide = 1 "
                        . "WHERE journalcomptable.id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query);

                //Valider Tous les séries des journaux comptables de l'exercice courant
                $query_serie = "UPDATE numeroseriejournal "
                        . "SET isbloque = 1, isvalide = 1 "
                        . "WHERE id_journal IN (SELECT id FROM journalcomptable WHERE id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'] . " )";

                $resultat = $conn->fetchAssoc($query_serie);

                die("OK");
        }

        public function executeCloturerExercice(sfWebRequest $request)
        {
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                $exercice_anterieur = DossierexerciceTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                $user = $this->getUser()->getAttribute('userB2m');
                $exercice_anterieur->setDatecloture(date('Y-m-d'));
                $exercice_anterieur->setCloture(true);
                $exercice_anterieur->setIdUsercloture($user->getId());

                $exercice_anterieur->save();

                die("OK");
        }

        public function executeAjouterExercice(sfWebRequest $request)
        {
                $user = $this->getUser()->getAttribute('userB2m');
                $id_user = $user->getId();
                $libelle = $_SESSION['exercice'] + 1;
                $date_debut = $libelle . '-01-01';
                $date_fin = $libelle . '-12-31';

                $exercice = new Exercice();

                $exercice->setLibelle($libelle);
                $exercice->setDateDebut($date_debut);
                $exercice->setDateFin($date_fin);
                $exercice->setType('comptablilite');
                $exercice->save();

                //        $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                //Exporter les comptes comptables de l'exercice courant vers l'exercice suivant
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "INSERT INTO plandossiercomptable(date, libelle, numerocompte, typesolde, id_dossier, id_plan, "
                        . "id_exercice) "
                        . " SELECT date, libelle, numerocompte, typesolde, id_dossier, id_plan,"
                        . " CAST(" . $exercice->getId() . " as integer) as id_exercice"
                        . " FROM plandossiercomptable WHERE id_dossier = " . $_SESSION['dossier_id']
                        . " AND id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query);

                $annee = date('Y', strtotime($exercice->getDateDebut()));
                $prefix = date('y', strtotime($exercice->getDateDebut()));
                //Exporter les journaux comptables de l'exercice courant vers l'exercice suivant
                $query = "INSERT INTO journalcomptable(code, libelle, numerotation, date, id_type_journal, id_comptecontrepartie,"
                        . " id_dossier, id_exercice,"
                        . "datedebutcloture,datefincloture) "
                        . " SELECT code, libelle, numerotation, date, id_type_journal, id_comptecontrepartie,"
                        . " id_dossier, CAST(" . $exercice->getId() . " as integer) as id_exercice"
                        . " , '" . $exercice->getDateDebut() . "' , '" . $exercice->getDateFin() . "'"
                        . "FROM journalcomptable WHERE id_dossier = " . $_SESSION['dossier_id']
                        . " AND id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query);

                //Exporter les séries des journaux comptables de l'exercice courant vers l'exercice suivant
                $journaux = JournalcomptableTable::getInstance()->getAllByDossierAndExerciceHavingSerie($_SESSION['dossier_id'], $exercice->getId());
                //        die(sizeof( $journaux)." mm");
                foreach ($journaux as $journal) {
                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                        $query_serie = "INSERT INTO public.numeroseriejournal(prefixe, datedebut, datefin, id_journal) "
                                . " VALUES ('" . $prefix . "01', '" . $annee . "-01-01', '" . $annee . "-01-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "02', '" . $annee . "-02-01', '" . date('Y-m-t', strtotime($annee . '-02-01')) . "', " . $journal->getId() . "), "
                                . " ('" . $prefix . "03', '" . $annee . "-03-01', '" . $annee . "-03-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "04', '" . $annee . "-04-01', '" . $annee . "-04-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "05', '" . $annee . "-05-01', '" . $annee . "-05-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "06', '" . $annee . "-06-01', '" . $annee . "-06-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "07', '" . $annee . "-07-01', '" . $annee . "-07-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "08', '" . $annee . "-08-01', '" . $annee . "-08-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "09', '" . $annee . "-09-01', '" . $annee . "-09-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "10', '" . $annee . "-10-01', '" . $annee . "-10-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "11', '" . $annee . "-11-01', '" . $annee . "-11-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "12', '" . $annee . "-12-01', '" . $annee . "-12-31', " . $journal->getId() . ")";

                        $resultat = $conn->fetchAssoc($query_serie);
                        //insert dans dossierexercice
                }

                $query_dossier_exerice = "INSERT INTO dossierexercice(id_dossier, id_exercice, date) VALUES ( "
                        . $_SESSION['dossier_id'] . "," . $exercice->getId() . ",'" . date('Y-m-d') . "')";

                $resultat = $conn->fetchAssoc($query_dossier_exerice);
                $dossierxercice = DossierexerciceTable::getInstance()->findOneByIdDossierAndIdExercice($_SESSION['dossier_id'], $exercice->getId());
                $query_dossier_exercice_affetcter = "INSERT INTO dossierexerciceutilisateur(id_utilisateur, id_dossierexercice, date) "
                        . "VALUES ( "
                        . $id_user . "," . $dossierxercice->getId()
                        //                . ' select id from dossierexercice where'
                        //                . ' id_dossier = ' . $_SESSION['dossier_id'] . ' and id_exercice= ' . $exercice->getId()
                        . ",'" . date('Y-m-d') . "')";

                $resultat_2 = $conn->fetchAssoc($query_dossier_exercice_affetcter);
                //        die($resultat_2);
                $query_valider_journal = "UPDATE journalcomptable "
                        . "SET iscloture= 1, isbloque = 1, isvalide = 1 "
                        . "WHERE journalcomptable.id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'];

                $resultat_3 = $conn->fetchAssoc($query_valider_journal);

                //Valider Tous les séries des journaux comptables de l'exercice courant
                $query_serie = "UPDATE numeroseriejournal "
                        . "SET isbloque = 1, isvalide = 1 "
                        . "WHERE id_journal IN (SELECT id FROM journalcomptable WHERE id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'] . " )";

                $resultat_4 = $conn->fetchAssoc($query_serie);
                //        $exercice = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                //        $annee = date('Y', strtotime($exercice->getDateDebut()));
                //        $prefix = date('y', strtotime($exercice->getDateDebut()));
                //        $query_maquette = "INSERT INTO maquette(code, libelle,  date, id_journal, id_naturepiece, id_user) "
                //                . " SELECT code, libelle,  date, " . $journal->getId() . ", id_naturepiece, id_user FROM maquette WHERE 
                //				id_dossier = " . $_SESSION['dossier_id'] . " AND id_exercice = " . $_SESSION['exercice_id'];
                //
                //        $resultat = $conn->fetchAssoc($query_maquette);
                die("OK");
        }

        public function executeExportPlanComptable(sfWebRequest $request)
        {
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                $exercice = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();

                //Exporter les comptes comptables de l'exercice courant vers l'exercice suivant
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "INSERT INTO plandossiercomptable(date, libelle, numerocompte, typesolde, id_dossier, id_plan, id_exercice) "
                        . " SELECT date, libelle, numerocompte, typesolde, id_dossier, id_plan, CAST(" . $exercice->getId() . " as integer) as id_exercice FROM plandossiercomptable WHERE id_dossier = " . $_SESSION['dossier_id'] . " AND id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query);

                die("OK");
        }

        public function executeExportJournauxComptable(sfWebRequest $request)
        {
                $dossier = $_SESSION['dossier_id'];
                $exercice = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                $annee = date('Y', strtotime($exercice->getDateDebut()));
                $prefix = date('y', strtotime($exercice->getDateDebut()));
                //Exporter les journaux comptables de l'exercice courant vers l'exercice suivant
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                //        die($exercice->getId());
                $query = "INSERT INTO journalcomptable(code, libelle, numerotation, date, id_type_journal, id_comptecontrepartie, id_dossier, id_exercice) "
                        . " SELECT code, libelle, numerotation, date, id_type_journal, id_comptecontrepartie, id_dossier, CAST(" . $exercice->getId() . " as integer) as id_exercice FROM journalcomptable WHERE id_dossier = " . $_SESSION['dossier_id'] . " AND id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query);
                //die($query);
                //Exporter les séries des journaux comptables de l'exercice courant vers l'exercice suivant
                $journaux = JournalcomptableTable::getInstance()->getAllByDossierAndExerciceHavingSerie($_SESSION['dossier_id'], $exercice->getId());
                foreach ($journaux as $journal) {
                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                        $query_serie = "INSERT INTO public.numeroseriejournal(prefixe, datedebut, datefin, id_journal) "
                                . " VALUES ('" . $prefix . "01', '" . $annee . "-01-01', '" . $annee . "-01-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "02', '" . $annee . "-02-01', '" . date('Y-m-t', strtotime($annee . '-02-01')) . "', " . $journal->getId() . "), "
                                . " ('" . $prefix . "03', '" . $annee . "-03-01', '" . $annee . "-03-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "04', '" . $annee . "-04-01', '" . $annee . "-04-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "05', '" . $annee . "-05-01', '" . $annee . "-05-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "06', '" . $annee . "-06-01', '" . $annee . "-06-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "07', '" . $annee . "-07-01', '" . $annee . "-07-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "08', '" . $annee . "-08-01', '" . $annee . "-08-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "09', '" . $annee . "-09-01', '" . $annee . "-09-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "10', '" . $annee . "-10-01', '" . $annee . "-10-31', " . $journal->getId() . "), "
                                . " ('" . $prefix . "11', '" . $annee . "-11-01', '" . $annee . "-11-30', " . $journal->getId() . "), "
                                . " ('" . $prefix . "12', '" . $annee . "-12-01', '" . $annee . "-12-31', " . $journal->getId() . ")";

                        $resultat = $conn->fetchAssoc($query_serie);
                }
                die("OK");
        }

        /* expoter maquete de saisie */

        public function executeExportMaquetteComptable(sfWebRequest $request)
        {
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                $exercice = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query_journal = 'select journalcomptable.id as id '
                        . 'from journalcomptable,maquette '
                        . 'where journalcomptable.code  in'
                        . ' ( select journalcomptable.code 
                    from journalcomptable,maquette,dossiercomptable,exercice 
                   where journalcomptable.id_dossier= ' . $_SESSION['dossier_id']
                        . 'and journalcomptable.id_exercice= ' . $_SESSION['exercice_id']
                        . ' and maquette.id_journal=journalcomptable.id
                   and journalcomptable.id_dossier=dossiercomptable.id
                   and journalcomptable.id_exercice=exercice.id' . ')'
                        . ' and journalcomptable.id_dossier= ' . $_SESSION['dossier_id']
                        . ' and id_exercice= ' . $exercice->getId()
                        . ' Group By journalcomptable.id';

                $journaux = $conn->fetchAssoc($query_journal);

                $query_journal_prece = 'select journalcomptable.id as id '
                        . 'from journalcomptable,maquette '
                        . 'where journalcomptable.code  in'
                        . ' ( select journalcomptable.code 
                    from journalcomptable,maquette,dossiercomptable,exercice 
                   where journalcomptable.id_dossier= ' . $_SESSION['dossier_id']
                        . 'and journalcomptable.id_exercice= ' . $_SESSION['exercice_id']
                        . ' and maquette.id_journal=journalcomptable.id
                   and journalcomptable.id_dossier=dossiercomptable.id
                   and journalcomptable.id_exercice=exercice.id' . ')'
                        . ' and journalcomptable.id_dossier= ' . $_SESSION['dossier_id']
                        . ' and id_exercice= ' . $_SESSION['exercice_id']
                        . ' Group By journalcomptable.id';


                $journaux_prece = $conn->fetchAssoc($query_journal_prece);

                $query_maquette_prece = 'select maquette.id as id '
                        . 'from maquette '
                        . 'where  maquette.id_journal in (select id from journalcomptable
                        where  journalcomptable.id_dossier= ' . $_SESSION['dossier_id']
                        . ' and id_exercice= ' . $_SESSION['exercice_id'] .')'
                        . ' Group By maquette.id';


                $maquette_prece = $conn->fetchAssoc($query_maquette_prece);

                // die(json_encode($journaux_prece).'f'.json_encode($journaux));
                $j = sizeof($journaux_prece) - 1;
                //$j = 0;
                for ($i = 0; $i < sizeof($journaux); $i++) {
                        $query_maquette = "INSERT INTO maquette(code, libelle,  date, id_journal, id_naturepiece, id_user) "
                                . "  SELECT  code, libelle,  date, "
                                . $journaux[$i]['id']
                                . ", id_naturepiece, id_user 
                    FROM maquette WHERE 
                    id_journal in (select id from journalcomptable where id_dossier= "
                                . $_SESSION['dossier_id'] . " and id_exercice=" . $_SESSION['exercice_id']
                                . " and journalcomptable.id=maquette.id_journal"
                                . " and journalcomptable.id=" . $journaux_prece[$j]['id'] . " )";
                        $resultat = $conn->fetchAssoc($query_maquette);
                        $j--;
                        //       $j++;
                }
                $maquettes = MaquetteTable::getInstance()->getByIdDossierAndExercice($_SESSION['dossier_id'], $exercice->getId());
                $k = sizeof($journaux_prece) - 1;
                $h = sizeof($maquette_prece) - 1;
                //foreach ($maquettes as $maquette) {
                for ($i = 0; $i < sizeof($maquettes); $i++) {
                        $query_ligne_maquette = "INSERT INTO lignemaquette(numero, obligatoirecompte,  obligatoiremontant,"
                                . "obligatoirecontre, specificationcompte, specificationmontant,"
                                . "specificationcontre,montant,numerolignemontant,taux,type,"
                                . "id_maquette,"
                                . "id_comptecomptable,"
                                . "id_contrepartie,tiers,compteretenue,id_compteretenue) "
                                . " SELECT numero, obligatoirecompte,  obligatoiremontant, obligatoirecontre, specificationcompte, 
                     specificationmontant,specificationcontre,montant,numerolignemontant,taux,type,
                     " . $maquettes[$i]['id'] . ',id_comptecomptable '
                                //                    ", select id_plan from plandossiercomptable where numerocompte in 
                                //                   (select numerocompte from plandossiercomptable where id_plan=id_comptecomptable)
                                //                   where 
                                //                    plandossiercomptable.id_dossier=" . $_SESSION['dossier_id']
                                //                    . " and plandossiercomptable.id_exercice=" . $exercice->getId() . ")"
                                . " ,id_contrepartie,tiers, compteretenue ,id_compteretenue
                     FROM lignemaquette WHERE 
                     id_maquette in (select id from maquette where id_journal in 
                     (select id from journalcomptable 
                     where  journalcomptable.id_dossier= " . $_SESSION['dossier_id']
                                . " and journalcomptable.id_exercice=" . $_SESSION['exercice_id']
                                . " and journalcomptable.id=" . $journaux_prece[$k]['id']
                                . " and maquette.id=" . $maquette_prece[$h]['id']
                                . "))";
                        die($query_ligne_maquette);

                        $resultat = $conn->fetchAssoc($query_ligne_maquette);
                        $k--;
                }


                die("OK");
        }

        public function executeProfil(sfWebRequest $request)
        {
        }

        public function executeSaveProfil(sfWebRequest $request)
        {
                $nom = $request->getParameter('nom');
                $prenom = $request->getParameter('prenom');
                $mail = $request->getParameter('mail');
                $gsm = $request->getParameter('gsm');
                $login = $request->getParameter('login');
                $password = $request->getParameter('password');

                $user = $this->getUser()->getAttribute('userB2m');
                $agent = $user->getAgents();
                $agent->setNomcomplet($nom);
                $agent->setPrenom($prenom);
                $agent->setGsm($gsm);
                $agent->setMail($mail);
                $agent->save();

                $user->setLogin($login);
                if ($password != '')
                        $user->setPwd($password);
                $user->save();

                die("OK");
        }

        public function executeGetExerciceByDossier(sfWebRequest $request)
        {
                $dossier_id = $request->getParameter('dossier_id');                
                $user = new Utilisateur();
                $user = $this->getUser()->getAttribute('userB2m');                
                $this->exercice_anterieurs = ExerciceTable::getInstance()->getByDossier($dossier_id, $user->getId());
                //        $this->exercice_anterieurs = DossierexerciceTable::getInstance()->getByDossier($dossier_id);
        }

        public function executeAnnulercloture(sfWebRequest $request)
        {
                //        $exercice_suiv = $_SESSION['exercice'] + 1;
                //        $exercice_suivant = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                $exerci_suiv = $_SESSION['exercice'] + 1;
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query_excerci_suiv = "select exercice.id as id "
                        . "from exercice,dossierexercice  "
                        . "WHERE dossierexercice.id_exercice = exercice.id "
                        . "And exercice.libelle='" . trim($exerci_suiv) . "'"
                        . "AND exercice.id in (select id_exercice "
                        . " from dossierexercice"
                        . " where id_dossier =" . $_SESSION['dossier_id'] . ")";
                $resultat_exerice = $conn->fetchAssoc($query_excerci_suiv);

                $id_exerice_suiv = $resultat_exerice[0]['id'];
                $id_dossier = $_SESSION['dossier_id'];
                //        $piece = PiececomptableTable::getInstance()->findOneByIdExercice($exercice_suivant->getId());

                $piece = PiececomptableTable::getInstance()->getPieceRAN($id_exerice_suiv);
                $query_plandossier = "UPDATE plandossiercomptable "
                        . " SET soldeouv = 0.000,solde=0.000"
                        . " WHERE  plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                        . " AND  plandossiercomptable.id_exercice = " . $id_exerice_suiv . "";

                $resultat = $conn->fetchAssoc($query_plandossier);
                //        die($query_plandossier.'id');
                if (sizeof($piece) > 0) {
                        foreach ($piece as $piec) {
                                foreach ($piec->getLignepiececomptable() as $ligne) {

                                        $ligne->delete();
                                }
                        }

                        $piece->delete();
                }
                $query_valider_journal = "UPDATE journalcomptable "
                        . "SET iscloture= 0, isbloque = 0, isvalide = 0 "
                        . "WHERE journalcomptable.id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'];

                $resultat = $conn->fetchAssoc($query_valider_journal);

                //Valider Tous les séries des journaux comptables de l'exercice courant
                $query_serie = "UPDATE numeroseriejournal "
                        . "SET isbloque = 0, isvalide = 0 "
                        . "WHERE id_journal IN (SELECT id FROM journalcomptable WHERE id_dossier = " . $_SESSION['dossier_id']
                        . " AND journalcomptable.id_exercice = " . $_SESSION['exercice_id'] . " )";

                $resultat = $conn->fetchAssoc($query_serie);
                // $query_plandossier = "UPDATE plandossiercomptable "
                //                . "SET soldeouv = 0.000, solde=0.000"
                //                . "WHERE  plandossiercomptable.numerocompte like '13%'"
                //                . " and  plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                //                . " AND  plandossiercomptable.id_exercice = " . $id_exerice_suiv . "";
                //
                //        $resultat = $conn->fetchAssoc($query_plandossier);
                die('ok');
        }

        /* actualiser solde plandossiercomptable */

        public function executeActulaiserlplandossiercomptable(sfWebRequest $request)
        {
                $dossier = $_SESSION['dossier_id'];
                $exercice = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                $plandossiercomptables = PlandossiercomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']);
                //update solde les comptes comptables de l'exercice courant vers l'exercice suivant
                foreach ($plandossiercomptables as $plandossier) {
                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();


                        $query = "Update   plandossiercomptable"
                                . " SET solde = (select  (coalesce(SUM(lignepiececomptable.montantdebit),0)-coalesce(SUM(lignepiececomptable.montantcredit),0))"
                                . " FROM plandossiercomptable, plancomptable, classecompte,piececomptable,lignepiececomptable"
                                . " WHERE plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                                . " AND plandossiercomptable.id_exercice = " . $_SESSION['exercice_id']
                                . " and lignepiececomptable.id_comptecomptable =plandossiercomptable.id"
                                . " and lignepiececomptable.id_piececomptable =piececomptable.id"
                                . " AND plandossiercomptable.id_plan = plancomptable.id AND plancomptable.id_classe = classecompte.id"
                                . " AND Length(plandossiercomptable.numerocompte)>=7"
                                . " AND plandossiercomptable.libelle is not null"
                                . " and plandossiercomptable.id =" . $plandossier->getId()
                                . " Group By plandossiercomptable.numerocompte,plandossiercomptable.libelle "
                                . " ORDER BY plandossiercomptable.numerocompte)"
                                . " WHERE plandossiercomptable.id_dossier =  " . $_SESSION['dossier_id']
                                . " AND plandossiercomptable.id_exercice =  " . $_SESSION['exercice_id']
                                . " and plandossiercomptable.id in (select id_comptecomptable from lignepiececomptable"
                                . " where  lignepiececomptable.id_comptecomptable =plandossiercomptable.id "
                                . " and plandossiercomptable.id =" . $plandossier->getId()
                                . " group by plandossiercomptable.id ,lignepiececomptable.id_comptecomptable)";
                        //            die($query);
                        $resultat = $conn->fetchAssoc($query);
                }
                $query_slde_ouv = "Update   plandossiercomptable"
                        . " SET soldeouv = 0.000"
                        // . " FROM plandossiercomptable"
                        . " WHERE plandossiercomptable.id_dossier = " . $_SESSION['dossier_id']
                        . " AND plandossiercomptable.id_exercice = " . $exercice->getId()
                        . " and soldeouv is null ";
                //  die($query_slde_ouv);
                $resultat = $conn->fetchAssoc($query_slde_ouv);
                die("OK");
        }
}
