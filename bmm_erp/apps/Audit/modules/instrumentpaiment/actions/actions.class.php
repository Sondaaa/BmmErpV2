<?php

require_once dirname(__FILE__) . '/../lib/instrumentpaimentGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/instrumentpaimentGeneratorHelper.class.php';

/**
 * instrumentpaiment actions.
 *
 * @package    Bmm
 * @subpackage instrumentpaiment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class instrumentpaimentActions extends autoInstrumentpaimentActions {

    public function executeListeInstrument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_caisse_banque = $params['idbanque'];
            $id_type_operation = $params['id_type_operation'];
            $caisse_banques = CaissesbanquesTable::getInstance()->find($id_caisse_banque);
            $type_operation = TypeoperationTable::getInstance()->find($id_type_operation);
            if ($type_operation->getCodeop() == 'CH-R' || $type_operation->getCodeop() == 'CH-E')
                $like_operation = 'CH';
            else if ($type_operation->getCodeop() == 'VR-R' || $type_operation->getCodeop() == 'VR-E')
                $like_operation = 'OV';
            else
                $like_operation = 'BC';

            if ($caisse_banques->getIdNature() == 1)
                $like_caisse_banque = '-B';
            else
                $like_caisse_banque = '-P';

            $q = Doctrine_Query::create()
                    ->select("id, libelle")
                    ->from('instrumentpaiment')
                    ->where("refinstrument LIKE '" . $like_operation . "%'")
                    ->andWhere("refinstrument NOT LIKE '%" . $like_caisse_banque . "'")
                    ->orderBy('libelle')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }    

}
