<?php

/**
 * Accueil actions.
 *
 * @package    Bmm
 * @subpackage Accueil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccueilActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        if (!isset($_SESSION['exercice']))
            $_SESSION['exercice'] = null;

        $exercice_annee = ExerciceTable::getInstance()->findOneByLibelle(date('Y'));
        if ($exercice_annee == null) {
            $exercice_annee = new Exercice();
            $exercice_annee->setLibelle(date('Y'));
            $date_debut = date('Y') . '-01-01';
            $exercice_annee->setDateDebut($date_debut);
            $date_fin = date('Y') . '-12-31';
            $exercice_annee->setDateFin($date_fin);
            $exercice_annee->save();
        }

        $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
        if ($dossier != null) {
            $this->dossier = $dossier;
        } else {
            $societe = SocieteTable::getInstance()->findAll()->getFirst();
            if ($societe != null) {
                $dossier = new Dossiercomptable();

                $dossier->setFax($societe->getFax());
                $dossier->setEmail($societe->getMail());
                $dossier->setDate(date('Y-m-d'));
                $dossier->setTelephoneun($societe->getTel());
                $dossier->setTelephonedeux($societe->getGsm());
                $dossier->setRaisonsociale($societe->getRs());
                $dossier->setMatriculefiscale($societe->getMatfiscal());

                $dossier->save();
            }
            $this->dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
        }

        $this->exercices = ExerciceTable::getInstance()->findAll();
    }

    public function executeValiderDossierCourant(sfWebRequest $request) {
        $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $dossier_id = $dossier->getId();
        $exercice_id = $request->getParameter('exercice_paie_id');

        $dossier_exercice = DossierExerciceTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id)->getFirst();
        if ($dossier_exercice == null) {
            $dossier_exercice = new DossierExercice();
            $dossier_exercice->setIdDossier($dossier_id);
            $dossier_exercice->setIdExercice($exercice_id);
            $dossier_exercice->save();
        }

        $dossier->setIdExercice($exercice_id);
        $dossier->save();

        $exercice = ExerciceTable::getInstance()->find($exercice_id);
        $_SESSION['exercice'] = $exercice->getLibelle();
        $_SESSION['exercice_paie_id'] = $exercice_id;

        die('ok');
    }
    
    public function executeProfil(sfWebRequest $request) {
        
    }

    public function executeSaveProfil(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $nom = $request->getParameter('nom');
        $prenom = $request->getParameter('prenom');
        $mail = $request->getParameter('mail');
        $gsm = $request->getParameter('gsm');
        $login = $request->getParameter('login');
        $password = $request->getParameter('password');

        $user =  $this->getUser()->getAttribute('userB2m');
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

}
