<?php

/**
 * Experiences form base class.
 *
 * @method Experiences getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExperiencesForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'description' => new sfWidgetFormInputText(),
            'organistaion' => new sfWidgetFormInputText(),
            'duree' => new sfWidgetFormInputText(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_typeexperience' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeexperience'), 'add_empty' => true)),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nordre' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'organistaion' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'duree' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'id_typeexperience' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeexperience'), 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'nordre' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('experiences[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Experiences';
    }

}
