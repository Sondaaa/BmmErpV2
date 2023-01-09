<?php

require_once dirname(__FILE__).'/../lib/souscorpsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/souscorpsGeneratorHelper.class.php';

/**
 * souscorps actions.
 *
 * @package    Bmm
 * @subpackage souscorps
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class souscorpsActions extends autoSouscorpsActions
{
    public function executeGetSouscorps(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents,"
                . " trim(souscorps.libelle)  as souscorps "
                . " from agents,contrat,salairedebase,categorierh ,souscorps"
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_salairedebase=salairedebase.id"
                . " and salairedebase.id_categorie= categorierh.id"
                . " and categorierh.id_souscorps=souscorps.id "
                . " group by souscorps"

        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParSouscorps(sfWebRequest $request) {
        
    }
}
