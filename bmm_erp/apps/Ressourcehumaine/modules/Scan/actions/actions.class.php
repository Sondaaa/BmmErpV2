<?php

/**
 * Scan actions.
 *
 * @package    Bmm
 * @subpackage Scan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScanActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    
    public function executeLancerscan(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        if (!isset($_REQUEST['id'])) {
            $user = $this->getUser()->getAttribute('userB2m');
            $chemin_exec = $user->getCheminexec();
            $this->redirect('http://localhost:8888/Scanner/index.php');
        }
        $q = Doctrine_Query::create()
                ->select("*")
                ->from('scanner');

        $scanners = $q->fetchArray();
        die(json_encode($scanners));
    }

  
}
