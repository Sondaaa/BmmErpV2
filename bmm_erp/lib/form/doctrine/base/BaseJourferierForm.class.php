<?php

/**
 * Jourferier form base class.
 *
 * @method Jourferier getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJourferierForm extends BaseFormDoctrine {

    public function setup() {
	
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'jour' => new sfWidgetFormInputText(),
            'mois' => new sfWidgetFormInputText(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'libelle' => new sfWidgetFormInputText(),
            'paye' => new sfWidgetFormInputCheckbox(),
			
            'periodique' => new sfWidgetFormInputCheckbox(),
			
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'jour' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'mois' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'paye' => new sfValidatorBoolean(array('required' => false)),
			'periodique' => new sfValidatorBoolean(array('required' => false)),
			
        ));

        $this->widgetSchema->setNameFormat('jourferier[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Jourferier';
    }

}
