<?php

require_once dirname(__FILE__) . '/../lib/dossiercomptableGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/dossiercomptableGeneratorHelper.class.php';

/**
 * dossiercomptable actions.
 *
 * @package    Bmm
 * @subpackage dossiercomptable
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dossiercomptableActions extends autoDossiercomptableActions {

    public function executeShow(sfWebRequest $request) {
        $this->dossier = DossierComptableTable::getInstance()->findAll()->getFirst();
        $this->exercices = ExerciceTable::getInstance()->findAll();
        $this->forme_juridiques = FormeJuridiqueTable::getInstance()->findAll();
        $this->secteur_activites = SecteurActiviteTable::getInstance()->findAll();
        $this->activites = ActivitetiersTable::getInstance()->findAll();
    }

    public function executeShowEdit(sfWebRequest $request) {
        $this->dossier = DossierComptableTable::getInstance()->findAll()->getFirst();
        $this->payss = PaysTable::getInstance()->LoadAllPaysExecute();
        $this->devises = DeviseTable::getInstance()->findAll();
        $this->forme_juridiques = FormeJuridiqueTable::getInstance()->findAll();
        $this->secteur_activites = SecteurActiviteTable::getInstance()->findAll();
        $this->activites = ActivitetiersTable::getInstance()->findAll();
        $this->exercices = ExerciceTable::getInstance()->findAll();
        $this->compte_attente = PlanComptableTable::getInstance()->getPlanComptableOrderByNumeroForSelect();
        $adresse = $this->dossier->getAdresse();
        if ($this->dossier->getIdAdresse() != null) {
            $ville = GouverneraTable::getInstance()->find($adresse->getIdCouvernera());
            if ($ville != null) {
                $this->villes = GouverneraTable::getInstance()->LoadVilleByIdPays($ville->getIdPays());
                $this->pays_id = $ville->getIdPays();
            } else {
                $this->villes = null;
                $this->pays_id = null;
            }
        } else {
            $this->villes = null;
            $this->pays_id = null;
        }
        $this->adresse = $adresse;
    }

    public function executeSaveEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $code = $request->getParameter('code');
        $raison_sociale = $request->getParameter('raison_sociale');
        $telephone_1 = $request->getParameter('telephone_1');
        $telephone_2 = $request->getParameter('telephone_2');
        $fax = $request->getParameter('fax');
        $email = $request->getParameter('email');
        $matricule_fiscale = $request->getParameter('matricule_fiscale');
        $registre_commerce = $request->getParameter('registre_commerce');
        $forme_juridique = $request->getParameter('forme_juridique');
        $secteur_activite = $request->getParameter('secteur_activite');
        $activite = $request->getParameter('activite');
        $code_postal = $request->getParameter('code_postal');
        $ville = $request->getParameter('ville');
        $adresse = $request->getParameter('adresse');
        $exercice = $request->getParameter('exercice');
        $assurancejouralpaie = $request->getParameter('assurancejouralpaie');
        $journalpaie = $request->getParameter('journalpaie');
        $controlerevenue = $request->getParameter('controlerevenue');
        $reparation = $request->getParameter('reparation');
        $situationprofess = $request->getParameter('situationprofess');
        $dateembauche = $request->getParameter('dateembauche');
        $editgrille = $request->getParameter('editgrille');
        $lignessp = $request->getParameter('lignessp');
        $mntlibelleprime = $request->getParameter('mntlibelleprime');
        $periode = $request->getParameter('periode');
        $soldeconge = $request->getParameter('soldeconge');
        $rib = $request->getParameter('rib');
        $qualificationcnss = $request->getParameter('qualificationcnss');
        $calculheuresupp = $request->getParameter('calculheuresupp');
        $nbravantage = $request->getParameter('nbravantage');
        $datefinavantage = $request->getParameter('datefinavantage');
        $dateentreenproduction = $request->getParameter('dateentreenproduction');
        $id_typeregime = $request->getParameter('id_typeregime');
        $tauxfoprolos = $request->getParameter('tauxfoprolos');
        $tauxtfp = $request->getParameter('tauxtfp');

        $id_contribution = $request->getParameter('id_contribution');
        $foprolos = $request->getParameter('foprolos');
        $tfp = $request->getParameter('tfp');
        $tauxacident = $request->getParameter('tauxtaccident');

        $dossier = DossierComptableTable::getInstance()->find($id);
        $adresse_dossier = $dossier->getAdresse();
        $adresse_id = '';
        if (intval($code_postal) > 0 && $adresse != '') {
            if ($adresse_dossier == null)
                $adresse_dossier = new Adresse();

            $adresse_dossier->setAdresse($adresse);
            $adresse_dossier->setCodepostal($code_postal);
            $adresse_dossier->setIdCouvernera($ville);

            $adresse_dossier->save();
            $adresse_id = $adresse_dossier->getId();
        }else {
            if ($adresse_dossier != null)
                $adresse_dossier->delete();
        }
        if ($activite != '' && intval($activite) > 0)
            $dossier->setIdActivitetier($activite);
        if ($adresse_id != '')
            $dossier->setIdAdresse($adresse_id);
        $dossier->setCode($code);
        $dossier->setDate(date('Y-m-d'));
        $dossier->setEmail($email);
        $dossier->setFax($fax);
        if ($forme_juridique != '' && intval($forme_juridique) > 0)
            $dossier->setIdFormejuridique($forme_juridique);
        $dossier->setMatriculefiscale($matricule_fiscale);

        $dossier->setRaisonsociale($raison_sociale);
        $dossier->setRegistrecommerce($registre_commerce);
        if ($secteur_activite != '' && intval($secteur_activite) > 0)
            $dossier->setIdSecteuractivite($secteur_activite);
        $dossier->setTelephonedeux($telephone_2);
        $dossier->setTelephoneun($telephone_1);
        if ($exercice != '' && intval($exercice) > 0)
            $dossier->setIdExercice($exercice);
        if ($tauxtfp != '')
            $dossier->setTauxtfp($tauxtfp);
        if ($tauxfoprolos != '')
            $dossier->setTauxfoprolos($tauxfoprolos);
        if ($tauxacident != '')
            $dossier->setTauxaccidentcotisation($tauxacident);
        if ($id_typeregime != '')
            $dossier->setIdTyperegime($id_typeregime);
        if ($dateentreenproduction != '')
            $dossier->setDateentreenproduction($dateentreenproduction);

        if ($id_contribution != '')
            $dossier->setIdLignecontribition($id_contribution);

        if ($tfp == 'true'):
            $dossier->setTfp("true");
        else:
            $dossier->setTfp("false");
        endif;
        if ($foprolos == 'true'):
            $dossier->setFoprolos("true");
        else:
            $dossier->setFoprolos("false");
        endif;

        if ($datefinavantage != '')
            $dossier->setDatefinavantage($datefinavantage);
        if ($nbravantage != '')
            $dossier->setNbravantage($nbravantage);
        if ($calculheuresupp == 'true'):
            $dossier->setCalculheuresupp("true");
        else:
            $dossier->setCalculheuresupp("false");
        endif;
        if ($qualificationcnss == 'true') {
            $dossier->setQualificationcnss("true");
        } else {
            $dossier->setQualificationcnss("false");
        }
        if ($rib == 'true')
            $dossier->setRib("true");
        else {
            $dossier->setRib("false");
        }
        if ($soldeconge == 'true')
            $dossier->setSoldeconge("true");
        else {
            $dossier->setSoldeconge("false");
        }

        if ($periode == 'true')
            $dossier->setPeriode("true");
        else {
            $dossier->setPeriode("false");
        }
        if ($mntlibelleprime == 'true')
            $dossier->setMntlibelleprime("true");
        else {
            $dossier->setMntlibelleprime("false");
        }

        if ($reparation == 'true')
            $dossier->setReparation("true");
        else {
            $dossier->setReparation("false");
        }
        if ($controlerevenue == 'true')
            $dossier->setControlerevenue("true");
        else {
            $dossier->setControlerevenue("false");
        }
        if ($journalpaie == 'true')
            $dossier->setJournalpaie("true");
        else {
            $dossier->setJournalpaie("false");
        }

        if ($assurancejouralpaie == 'true')
            $dossier->setAssurancejouralpaie("true");
        else {
            $dossier->setAssurancejouralpaie("false");
        }

        if ($situationprofess == 'true')
            $dossier->setSituationprofess("true");
        else {
            $dossier->setSituationprofess("false");
        }
        if ($dateembauche == 'true')
            $dossier->setDateembauche("true");
        else {
            $dossier->setDateembauche("false");
        }


        if ($editgrille == 'true')
            $dossier->setEditgrille("true");
        else {
            $dossier->setEditgrille("false");
        }


        if ($lignessp == 'true')
            $dossier->setLignessp("true");
        else {
            $dossier->setLignessp("false");
        }


        if ($exercice != '')
            $dossier->setIdExercice($exercice);


        $dossier->save();

        die('ok');
    }

    //save document ligne regime horaire

    public function executeSavedocumentRegime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listedocsRegimehoraire = $params['listedocsRegimehoraire'];
            $id_dossier = $params['id_dossier'];
            foreach ($listedocsRegimehoraire as $lignedocRegimehoraire) {

                $numero = $lignedocRegimehoraire['norgdre'];
                $regime = $lignedocRegimehoraire['idregime'];
                $pardefaut = $lignedocRegimehoraire['pardefaut'];
                $lignedocEE = new Ligneregimehoraire();
                if ($numero != "")
                    $lignedocEE->setNordre($numero);

                if ($regime != "")
                    $lignedocEE->setIdRegime($regime);
                if ($id_dossier != "")
                    $lignedocEE->setIdDossier($id_dossier);

                if ($pardefaut != "")
                    $lignedocEE->setPardefaut($pardefaut);
                if ($pardefaut == 'true')
                    $lignedocEE->setPardefaut(true);
                else
                    $lignedocEE->setPardefaut(false);
                $lignedocEE->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeAfficheligneDossier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_dossier = $params['id'];

            $query = " select ligneregimehoraire.nordre as norgdre , ligneregimehoraire.pardefaut as pardefaut,"
                    . " regimehoraire.libelle as regime"
                    . " from regimehoraire ,ligneregimehoraire"
                    . " where ligneregimehoraire.id_dossier=" . $id_dossier . ""
                    . " and ligneregimehoraire.id_regime=regimehoraire.id";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

}
