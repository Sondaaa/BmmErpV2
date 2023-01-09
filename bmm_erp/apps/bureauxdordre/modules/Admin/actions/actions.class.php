<?php

/**
 * admin actions.
 *
 * @package    Caisse
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adminActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeConnect(sfWebRequest $request) {

         if ( $this->getUser()->isAuthenticated()) {
           
            $this->redirect("Accueil/global");
        }
       
        if ($request->getParameter('login')) {
            $login = $request->getParameter('login');
            $pwd = $request->getParameter('password');
         
            $user=new Utilisateur();
            //die(strtoupper(trim($login)));
           $utilisateur = Doctrine_Core::getTable('utilisateur')
                            ->createQuery('a')
                            ->where("UPPER(trim(a.login)) like '" . strtoupper(trim($login)) . "'")
//                            ->andWhere("is_active = true")
                            ->execute();
           
                  // die(count($utilisateur).'jjjj') ;
            if (count($utilisateur)>=0 && $user->getValidePassword($pwd,$utilisateur, $this->getUser())) {
                
                     //die('ok');
                    $this->getUser()->setAttribute('userB2m', $user->getUserConnected($this->getUser()));
                  
                     sfConfig::set('userB2m', $user->getUserConnected($this->getUser()));
                   
//                      $_SESSION['user']=$user->getUserConnected($this->getUser());
                     // die($_SESSION['user']);
                      if (!$this->getUser()->isAuthenticated())
                        {
                          $this->getUser()->setAuthenticated(true);
                         
                          
                        }
                        $this->redirect("Accueil/global");
                
                
            }
          
          
         
                 
           
        }
    }
    public function executeDeconnect(sfWebRequest $request) {

       $this->getUser()->setAuthenticated(false);
        $this->getUser()->ClearUserConnected();
        $this->getUser()->resetUserConnected();
        return $this->redirect("@connect");
    }
}
