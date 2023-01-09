<?php

/**
 * Demandeavance form base class.
 *
 * @method Demandeavance getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandeavanceForm extends BaseFormDoctrine {

    public function setup() {
        $mois = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
        $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->where('a.id_motifabsence IS NULL ')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($agents as $req) {
            $choices[$req->getId()] = $req->getIdrh() . " " . $req->getNomcomplet() . " " . $req->getPrenom();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'montanttotal' => new sfWidgetFormInputText(),
            'montantmensielle' => new sfWidgetFormInputText(),
            'id_typeavance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'add_empty' => true)),
            'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
            'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
            'datedebutretenue' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefinretenue' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'paye' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'montanttotal' => new sfValidatorNumber(array('required' => false)),
            'montantmensielle' => new sfValidatorNumber(array('required' => false)),
            'id_typeavance' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'mois' => new sfValidatorInteger(array('required' => false)),
            'datedebutretenue' => new sfValidatorDate(array('required' => false)),
            'datefinretenue' => new sfValidatorDate(array('required' => false)),
            'paye' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('demandeavance[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandeavance';
    }

}
