<?php

require_once dirname(__FILE__) . '/../lib/demandeurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandeurGeneratorHelper.class.php';

/**
 * demandeur actions.
 *
 * @package    Bmm
 * @subpackage demandeur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeurActions extends autoDemandeurActions {

    public function executeSaveDemandeur(sfWebRequest $request) {
        $choix = $request->getParameter('choix');
        $ids = $request->getParameter('ids');

        $ids = explode(',,', $ids);

        switch ($choix) {
            case 'zone_agent':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdAgent($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $agent = AgentsTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($agent->getNomcomplet());
                            $demandeur->setIdAgent($ids[$i]);

                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_service':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdService($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $service = ServicerhTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($service->getLibelle());
                            $demandeur->setIdService($ids[$i]);

                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_unite':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdUnite($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $unite = UniteTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($unite->getLibelle());
                            $demandeur->setIdUnite($ids[$i]);

                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_direction':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdDirection($ids[$i]);
                        if ($demandeur->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $direction = DirectionTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($direction->getLibelle());
                            $demandeur->setIdDirection($ids[$i]);

                            $demandeur->save();
                        }
                    }
                }
                break;
            case 'zone_sous_direction':
                for ($i = 0; $i < sizeof($ids); $i++) {
                    if ($ids[$i] != '') {
                        $demandeur = DemandeurTable::getInstance()->findByIdSousdirection($ids[$i]);
                        if ($demandeu->count() != 0) {
                            //rien à faire
                        } else {
                            $demandeur = new Demandeur();

                            $sous_direction = SousdirectionTable::getInstance()->find($ids[$i]);
                            $demandeur->setLibelle($sous_direction->getLibelle());
                            $demandeur->setIdSousdirection($ids[$i]);

                            $demandeur->save();
                        }
                    }
                }
                break;

            default:
                break;
        }
    }

}
