<?php

/**
 * Instrumentpaiment form base class.
 *
 * @method Instrumentpaiment getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInstrumentpaimentForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'libelle' => new sfWidgetFormInputText(),
            'refinstrument' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'refinstrument' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('instrumentpaiment[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Instrumentpaiment';
    }

}
