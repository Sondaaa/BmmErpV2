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
        
        if (! $this->getUser()->isAuthenticated()) {
           
           return  $this->redirect('/',302);
        }
       
    
       
         
        
    }
    public function executeLogin(sfWebRequest $request) {
 
       
        
    }

    public function executeDeconnect(sfWebRequest $request) {
       
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->ClearUserConnected();
        $this->getUser()->resetUserConnected();
        return $this->redirect("@connect");
    }

}
