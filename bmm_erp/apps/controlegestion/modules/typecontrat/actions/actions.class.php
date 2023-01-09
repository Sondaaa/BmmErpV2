<?php

require_once dirname(__FILE__) . '/../lib/typecontratGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/typecontratGeneratorHelper.class.php';

/**
 * typecontrat actions.
 *
 * @package    Bmm
 * @subpackage typecontrat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typecontratActions extends autoTypecontratActions {

    public function executeGetTypeContrat(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents"
                . ", trim(typecontrat.libelle)  as typecontrat "
                . " from agents,contrat,typecontrat "
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_typecontrat=typecontrat.id"
                . " group by typecontrat";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParTypeContrat(sfWebRequest $request) {
        
    }

}
