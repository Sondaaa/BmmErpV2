<?php

require_once dirname(__FILE__) . '/../lib/parametragesocieteGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/parametragesocieteGeneratorHelper.class.php';

/**
 * parametragesociete actions.
 *
 * @package    Bmm
 * @subpackage parametragesociete
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parametragesocieteActions extends autoParametragesocieteActions {

    //__________________________________________________________________________Parametragesociete
    public function executeParametragesociete(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idsoc = $params['idsoc'];
            $query = "SELECT  COALESCE(parametragesociete.valeurfodec, 0), COALESCE(parametragesociete.timbre, 0), UPPER(societe.rs) as rs, "
                    . " societe.matfiscal, societe.logo, societe.codepostal, "
                    . " societe.tel, societe.gsm, societe.fax, societe.adresse, "
                    . " societe.mail, COALESCE(gouvernera.gouvernera, ''), COALESCE(pays.pays, '') "
                    . " FROM societe, parametragesociete, gouvernera, pays "
                    . " WHERE societe.id_gouvernera = gouvernera.id AND societe.id_pays = pays.id "
                    . " AND  parametragesociete.id_societe = societe.id and societe.id=" . $idsoc;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parametrage = $conn->fetchAssoc($query);

            die(json_encode($parametrage));
        }
        die('bien');
    }

}
