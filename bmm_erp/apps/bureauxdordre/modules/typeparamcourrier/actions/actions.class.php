<?php

require_once dirname(__FILE__) . '/../lib/typeparamcourrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/typeparamcourrierGeneratorHelper.class.php';

/**
 * typeparamcourrier actions.
 *
 * @package    Bmm
 * @subpackage typeparamcourrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typeparamcourrierActions extends autoTypeparamcourrierActions {

    public function executeAjouterTypeCourrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];

            //verification d'existance
            $query_existe = "SELECT typeparamcourrier.id,typeparamcourrier.libelle "
                    . "FROM typeparamcourrier "
                    . " WHERE trim(typeparamcourrier.libelle) = '" . $libelle . "'";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listes_existe = $conn->fetchAssoc($query_existe);

            if (sizeof($listes_existe) == 0) {
                $typeparamcourrier = new Typeparamcourrier();
                $typeparamcourrier->setLibelle($libelle);
                $typeparamcourrier->save();
            }
            $query = "SELECT typeparamcourrier.id,typeparamcourrier.libelle "
                    . "FROM typeparamcourrier "
                    . " order by typeparamcourrier.libelle";

            $listes = $conn->fetchAssoc($query);
            die(json_encode($listes));
        }
        die('Erreur');
    }

}
