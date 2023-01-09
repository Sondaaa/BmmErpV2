<?php

/**
 * Accidents form base class.
 *
 * @method Accidents getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccidentsForm extends BaseFormDoctrine {

    public function setup() {
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
            'raison' => new sfWidgetFormInputText(),
            'adresse' => new sfWidgetFormInputText(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'duree' => new sfWidgetFormInputText(),
            'typehandicap' => new sfWidgetFormInputText(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'type' => new sfWidgetFormInputText(),
            'nbrjour' => new sfWidgetFormInputText(),
            'motif' => new sfWidgetFormInputText(),
            'observation' => new sfWidgetFormTextarea(),
            'id_lieu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'raison' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'adresse' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'duree' => new sfValidatorInteger(array('required' => false)),
            'typehandicap' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'type' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'nbrjour' => new sfValidatorInteger(array('required' => false)),
            'motif' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'observation' => new sfValidatorString(array('required' => false)),
            'id_lieu' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('accidents[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Accidents';
    }

}
