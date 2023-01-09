<?php

require_once dirname(__FILE__) . '/../lib/famillearticleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/famillearticleGeneratorHelper.class.php';

/**
 * famillearticle actions.
 *
 * @package    Bmm
 * @subpackage famillearticle
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class famillearticleActions extends autoFamillearticleActions {

    public function executeAffichecode(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idfamille = $params['idfamille'];

            $lgdoc = Doctrine_Core::getTable('famillearticle')->findOneById($idfamille);
            if ($lgdoc) {
                die($lgdoc->getId() . "");
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

    public function executeAffichesousfamille(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idfamille = $params['idfamille'];
            $sousfailles = Doctrine_Query::create()
                    ->select("*")
                    ->from('sousfamillearticle')
                    ->where('id_famille=' . $idfamille);

            $sousfailles = $sousfailles->fetchArray();
            die(json_encode($sousfailles));
        }
        die('Mise à jour effectuée avec succès');
    }

}
