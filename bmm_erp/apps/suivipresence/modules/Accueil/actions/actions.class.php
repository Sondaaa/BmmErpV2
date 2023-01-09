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
  public function executeGlobal(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
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
