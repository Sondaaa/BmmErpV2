<?php

require_once dirname(__FILE__) . '/../lib/caracteristiquearticleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/caracteristiquearticleGeneratorHelper.class.php';

/**
 * caracteristiquearticle actions.
 *
 * @package    Bmm
 * @subpackage caracteristiquearticle
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class caracteristiquearticleActions extends autoCaracteristiquearticleActions {

    public function executeAjoutercar(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idarticle = $params['idarticle'];
            $idcar = $params['idcar'];
            $valeur = $params['valeur'];
            $lignecar = new Lignecararticle();
            //die($idarticle.' c'.$idcar.' '.$valeur);
            if ($idarticle != "" && $idcar != "" && $valeur != "") {
                $listeslignes = Doctrine_Core::getTable('lignecararticle')->findOneByIdArticleAndIdCar($idarticle, $idcar);
                if ($listeslignes)
                    $lignecar = $listeslignes;
                $lignecar->setIdArticle($idarticle);
                $lignecar->setIdCar($idcar);
                $lignecar->setValeurlibelle($valeur);
                $lignecar->save();
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

    public function executeSupprimercar(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);


            $idligne = $params['idligne'];


            $listeslignes = Doctrine_Core::getTable('lignecararticle')->findOneById($idligne);
            if ($listeslignes) {
                $lignecar = $listeslignes;
                $lignecar->delete();
            }
        }
        die('Mise à jour effectuée avec succès');
    }

    public function executeAffichecar(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idarticle = $params['idarticle'];


            if ($idarticle != "") {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT  lignecararticle.id,  lignecararticle.valeurlibelle,    caracteristiquearticle.libelle "
                        . "FROM    caracteristiquearticle,    lignecararticle   "
                        . "where id_article=" . $idarticle . " "
                        . " AND lignecararticle.id_car=caracteristiquearticle.id "
                        . "group by lignecararticle.id,  lignecararticle.valeurlibelle,    caracteristiquearticle.libelle";
                $listescar = $conn->fetchAssoc($query);

                die(json_encode($listescar));
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

}
