<?php

require_once dirname(__FILE__) . '/../lib/activitetiersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/activitetiersGeneratorHelper.class.php';

/**
 * activitetiers actions.
 *
 * @package    Bmm
 * @subpackage activitetiers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class activitetiersActions extends autoActivitetiersActions {

    //______________________________________________________________________Ajouter Activiter
    public function executeAjoutactiviter(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $act=new Activitetiers();
            $activite = Doctrine_Core::getTable('activitetiers')->findOneByLibelle($libelle);
            if($activite)
                $act=$activite;
            $act->setLibelle($libelle);
            $act->save();
            $listes = Doctrine_Query::create()
                    ->select("*")
                    ->from('activitetiers');

            $listes = $listes->fetchArray();
            die(json_encode($listes));
        }
        die('Erreur d\'ajout');
    }

}
