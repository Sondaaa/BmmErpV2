<?php

require_once dirname(__FILE__) . '/../lib/deductioncommuneGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/deductioncommuneGeneratorHelper.class.php';

/**
 * deductioncommune actions.
 *
 * @package    Bmm
 * @subpackage deductioncommune
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class deductioncommuneActions extends autoDeductioncommuneActions {

    public function executeAfficehdemontantchef(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = 1;

            $query = " SELECT deductioncommune.montant as montant "
                    . " from deductioncommune"
                    . " where deductioncommune.id=" . $id . "";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsP = $conn->fetchAssoc($query);
            die(json_encode($listedocsP));
        }
        die("bien");
    }

}
