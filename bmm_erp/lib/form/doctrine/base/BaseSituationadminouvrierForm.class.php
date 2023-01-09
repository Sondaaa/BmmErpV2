<?php

/**
 * Situationadminouvrier form base class.
 *
 * @method Situationadminouvrier getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSituationadminouvrierForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'libelle' => new sfWidgetFormInputText(),
            'montant' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'montant' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('situationadminouvrier[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Situationadminouvrier';
    }

}
