<?php

/**
 * Typetenue form base class.
 *
 * @method Typetenue getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTypetenueForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'libelle' => new sfWidgetFormTextarea(),
            'id_typemisson' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('required' => false)),
            'id_typemisson' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('typetenue[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Typetenue';
    }

}
