<?php

require_once dirname(__FILE__) . '/../lib/agentsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/agentsGeneratorHelper.class.php';

/**
 * agents actions.
 *
 * @package    Bmm
 * @subpackage agents
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agentsActions extends autoAgentsActions {

    public function executeTestidrh(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idrh'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id as id, agents.cin as cin,agents.idrh as idrh "
                    . " FROM agents"
                    . " WHERE agents.idrh ='" . $id . "'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }
    
      public function executeTestcin(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $cin = $params['cin'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  agents.id as id,agents.idrh as idrh ,agents.cin as cin"
                    . " FROM agents"
                    . " WHERE agents.cin='" . $cin . "'";
         $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }


}
