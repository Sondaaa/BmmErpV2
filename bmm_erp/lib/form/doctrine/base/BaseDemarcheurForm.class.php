<?php

/**
 * Demarcheur form base class.
 *
 * @method Demarcheur getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemarcheurForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'nomcomplet' => new sfWidgetFormInputText(),
            'gsm' => new sfWidgetFormInputText(),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nomcomplet' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'gsm' => new sfValidatorString(array('max_length' => 8, 'required' => false)),
            'id_agent' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('demarcheur[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demarcheur';
    }

}
