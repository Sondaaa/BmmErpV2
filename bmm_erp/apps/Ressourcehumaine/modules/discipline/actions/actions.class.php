<?php

require_once dirname(__FILE__).'/../lib/disciplineGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/disciplineGeneratorHelper.class.php';

/**
 * discipline actions.
 *
 * @package    Bmm
 * @subpackage discipline
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class disciplineActions extends autoDisciplineActions
{  
   
     public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
           $idtype = $params['idag']; //die('ss'.$id);
            if ($idtype) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT naturediscipline.id as id , naturediscipline.libelle as libelle "
                        . " FROM naturediscipline"
                        . " WHERE naturediscipline.id_typediscipline = " . $idtype;
                $magNature = $conn->fetchAssoc($query);

                die(json_encode($magNature));
            }
        }

        die("Erreur");
    }
}