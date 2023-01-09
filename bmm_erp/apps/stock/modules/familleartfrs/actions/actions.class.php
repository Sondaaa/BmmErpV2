<?php

require_once dirname(__FILE__).'/../lib/familleartfrsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/familleartfrsGeneratorHelper.class.php';

/**
 * familleartfrs actions.
 *
 * @package    Bmm
 * @subpackage familleartfrs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class familleartfrsActions extends autoFamilleartfrsActions
{
    //______________________________________________________________________Ajouter famille
    public function executeAjoutfamille(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $act=new Familleartfrs();
            $activite = Doctrine_Core::getTable('familleartfrs')->findOneByLibelle($libelle);
            if($activite)
                $act=$activite;
            $act->setLibelle($libelle);
            $act->save();
            $listes = Doctrine_Query::create()
                    ->select("*")
                    ->from('familleartfrs');

            $listes = $listes->fetchArray();
            die(json_encode($listes));
        }
        die('Erreur d\'ajout');
    }
}
