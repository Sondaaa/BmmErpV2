<?php

require_once dirname(__FILE__) . '/../lib/typecongeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/typecongeGeneratorHelper.class.php';

/**
 * typeconge actions.
 *
 * @package    Bmm
 * @subpackage typeconge
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typecongeActions extends autoTypecongeActions {

    //save dentete type conge
    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $nbrjour = $params['nbrjour'];
            $paye = $params['paye'];
            $modalite = $params['modalite'];

            $id = $params['id'];
            $typeconge = new Typeconge();
            if ($id != "") {
                $tycon = Doctrine_Core::getTable('typeconge')->findOneById($id);
                if ($tycon)
                    $typeconge = $tycon;
            }
            if ($libelle != "")
                $typeconge->setLibelle($libelle);
            if ($nbrjour != "")
                $typeconge->setNbrjour($nbrjour);

            if ($paye == 'true')
                $typeconge->setPaye(true);
            else
                $typeconge->setPaye(false);

            if ($modalite != "")
                $typeconge->setModalitecalcul($modalite);


            $typeconge->save();
            die($typeconge->getId() . "");
        }
        die('erreurr !!!');
    }

    //save 

    public function executeSavedocumentClassificatontypeconge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $liste = $params['listedocsClassificationConge'];
            $idtype = $params['typeconge_id'];
            if ($idtype) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                Doctrine_Query::create()->delete('lignetypeconge')
                        ->where('id_typeconge=' . $idtype)->execute();
            }
            foreach ($liste as $lignedocClassificationConge) {
                $typetraitement = $lignedocClassificationConge['typetraitement'];
                $commisioncomplet = $lignedocClassificationConge['commmsion'];
                $nbrjour = $lignedocClassificationConge['nbrj'];
                 $nordre = $lignedocClassificationConge['norgdre'];
                $LignetypecongeC = new Lignetypeconge();
                 if ($nordre != "")
                    $LignetypecongeC->setNordre($nordre);
                  
                if ($typetraitement != "")
                    $LignetypecongeC->setTypetraitement($typetraitement);
                if ($nbrjour != "")
                    $LignetypecongeC->setNbrjour($nbrjour);

                if ($commisioncomplet == 'true')
                    $LignetypecongeC->setCommisioncomplet(true);
                else
                     $LignetypecongeC->setCommisioncomplet(false);
                      if ($idtype != "")
                    $LignetypecongeC->setIdTypeconge($idtype);

                    $LignetypecongeC->save();
            }
        }
        die('ajout avec succe');
    }

    //edit 
    public function executeEdit(sfWebRequest $request) {

        $this->typeconge = Doctrine_Core::getTable('typeconge')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->typeconge);
    }

    
    //affichage ligne type conge
    
    
       public function executeAfficheligneTypeConge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $query = " select lignetypeconge.nordre as norgdre"
                    . ",lignetypeconge.typetraitement as typetraitement ,"
                    . " lignetypeconge.commisioncomplet  as commmsion,"
                    . " lignetypeconge.nbrjour as nbrj "
                    . " from lignetypeconge "
                    . " where lignetypeconge.id_typeconge=".$id
                    . " ORDER BY nordre ASC"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

}
