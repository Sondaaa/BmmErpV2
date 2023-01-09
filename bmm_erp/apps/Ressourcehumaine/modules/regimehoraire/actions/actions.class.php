<?php

require_once dirname(__FILE__) . '/../lib/regimehoraireGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/regimehoraireGeneratorHelper.class.php';

/**
 * regimehoraire actions.
 *
 * @package    Bmm
 * @subpackage regimehoraire
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class regimehoraireActions extends autoRegimehoraireActions {

    public function executeVoirFiche(sfWebRequest $request) {

        $this->regimehoraire = Doctrine_Core::getTable('regimehoraire')->findOneById($request->getParameter('id'));
        $this->id = $request->getParameter('id');
        $this->form = $this->configuration->getForm($this->regimehoraire);
    }

    public function executeEditRegime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $heure_jours = $params['heure_jours'];
            $jour = $params['jour'];
            $jourr = $params['jourr'];
            $heure_jours = explode(',', $heure_jours);
            $jourr = explode(',', $jourr);
            $jour = explode(',', $jour);
            Doctrine_Query::create()->delete('grilleregimehoraire')
                    ->where('id_regime=' . $id)->execute();
            for ($i = 0; $i < sizeof($jour) - 1; $i++) {

                $ligneregime = new Grilleregimehoraire();

                if ($id != '') {
                    $ligneregime->setIdRegime($id);
                }
                if ($jour[$i] != '') {
                    $ligneregime->setJour($jour[$i]);
                }
                if ($heure_jours[$i] != '') {
                    $ligneregime->setNbrheuret($heure_jours[$i]);
                }
                if ($jourr[$i] == 'true') {
                    $ligneregime->setJourrepos(true);
                } else
                    $ligneregime->setJourrepos(false);
                $ligneregime->setAnnee(date('Y'));
                $ligneregime->save();
            }
            die($ligneregime->getId());
        }
        die('erreur !!');
    }

    public function executeAfficherRegime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $query = " select  grilleregimehoraire.jour as jour,"
                    . " grilleregimehoraire.nbrheuret as  nbrheuret ,"
                    . "grilleregimehoraire.jourrepos as jourrepos "
                    . " from grilleregimehoraire "
                    . "   where grilleregimehoraire.id_regime=" . $id
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

}
