<?php

require_once dirname(__FILE__) . '/../lib/demandeavancepretGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandeavancepretGeneratorHelper.class.php';

/**
 * demandeavancepret actions.
 *
 * @package    Bmm
 * @subpackage demandeavancepret
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeavancepretActions extends autoDemandeavancepretActions {

    public function executeAfficehdetailAvance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $type_avance = $params['type_avance'];
            $query = " select  avance.remboursement as remboursement"
                    . " from avance "
                    . " where  avance.id= " . $type_avance
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

}
