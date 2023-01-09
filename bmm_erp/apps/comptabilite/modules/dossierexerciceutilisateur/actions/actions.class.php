<?php

require_once dirname(__FILE__) . '/../lib/dossierexerciceutilisateurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/dossierexerciceutilisateurGeneratorHelper.class.php';

/**
 * dossierexerciceutilisateur actions.
 *
 * @package    Bmm
 * @subpackage dossierexerciceutilisateur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dossierexerciceutilisateurActions extends autoDossierexerciceutilisateurActions {

    //ajouter ajout 
    public function executeAjouterAgents(sfWebRequest $request) {
        $matricule = $request->getParameter('matricule');
        $cin = $request->getParameter('cin');
        $prenom = $request->getParameter('prenom');
        $nom = $request->getParameter('nom');
        $date = $request->getParameter('date');
        $lieun = $request->getParameter('lieun');
        $sexe = $request->getParameter('sexe');
        $etatcivile = $request->getParameter('etatcivile');
        $ville = $request->getParameter('ville');
        $pays = $request->getParameter('pays');
        $id_dossier = $request->getParameter('id_dossier');
        $adresse = $request->getParameter('adresse');
        $login = $request->getParameter('login');
        $pwd = $request->getParameter('pwd');
        $etatutilisateur = $request->getParameter('etatutilisateur');
//        $agents = AgentsTable::getInstance()->findByIdrh($request->getParameter('matricule'));
        $agents = new Agents();
        $utlisateur = new Utilisateur();

        $agents = new Agents();
        if ($matricule)
            $agents->setIdrh($matricule);
        if ($nom)
            $agents->setNomcomplet($nom);
        if ($prenom)
            $agents->setPrenom($prenom);
        if ($date)
            $agents->setDatenaissance($date);
        if ($lieun)
            $agents->setLieun($lieun);
        if ($sexe)
            $agents->setIdSexe($sexe);
        if ($etatcivile)
            $agents->setIdEtatcivil($etatcivile);
        if ($ville)
            $agents->setIdGouvn($ville);
        if ($pays)
            $agents->setIdPays($pays);
        if ($id_dossier)
            $agents->setIdDossier($id_dossier);
        if ($adresse)
            $agents->setAdresse($adresse);

        $agents->save();
        $utlisateur->setIdParent($agents->getId());
        if ($login)
            $utlisateur->setLogin($login);
        if ($pwd)
            $utlisateur->setPwd($pwd);

        if ($etatutilisateur)
            $utlisateur->setEtatconnect($etatutilisateur);
        $utlisateur->save();
        $this->user = UtilisateurTable::getInstance()->getAllByOrder();
        die('ok');
    }

//ajouter utilisateur 
    public function executeAjouterUtilisateur(sfWebRequest $request) {
        $agents_id = $request->getParameter('agents_id');
        $login = $request->getParameter('login');
        $pwd = $request->getParameter('pwd');
        $etat = $request->getParameter('etat');

        $user = UtilisateurTable::getInstance()->findByIdParent($agents_id);
        if ($user->count() != 0) {
            return $this->renderText('existe');
        } else {
            $user = new Utilisateur();
            $user->setLogin($login);
            $user->setPwd($pwd);
            $user->setIdParent($agents_id);
            $user->setEtatconnect($etat);

            $user->save();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT utilisateur.id as id,"
                    . "agents.id as id , "
                    . "agents.idrh as idrh ,"
                    . "agents.nomcomplet as nom , agents.prenom as prenom "
                    . " FROM utilisateur,agents"
                    . " where utilisateur.id_parent=agents.id "

            ;
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
//            $listeagents = AgentsTable::getInstance()->getAllByNomComplet();
//
//            if ($request->isXmlHttpRequest()) {
//                return $this->listeagents;
//            }
//            die($this->getAllActivitetiers($request));
        }
    }

}
