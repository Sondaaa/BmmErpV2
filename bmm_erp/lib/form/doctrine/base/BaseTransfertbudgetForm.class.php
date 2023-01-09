<?php

/**
 * Transfertbudget form base class.
 *
 * @method Transfertbudget getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransfertbudgetForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_source' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
            'id_destination' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub_2'), 'add_empty' => true)),
            'id_typetransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typetransfert'), 'add_empty' => true)),
            'objectif' => new sfWidgetFormTextarea(),
            'description' => new sfWidgetFormTextarea(),
            'mnttransfert' => new sfWidgetFormInputText(),
            'sourcebudget' => new sfWidgetFormTextarea(),
			  'etattransfert'    => new sfWidgetFormTextarea(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'datecreation' => new sfValidatorDate(array('required' => true)),
            'id_source' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'required' => false)),
            'id_destination' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub_2'), 'required' => true)),
            'id_typetransfert' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typetransfert'), 'required' => false)),
            'objectif' => new sfValidatorString(array('required' => false)),
            'description' => new sfValidatorString(array('required' => false)),
            'mnttransfert' => new sfValidatorNumber(array('required' => true)),
            'sourcebudget' => new sfValidatorString(array('required' => false)),
			 'etattransfert'    => new sfValidatorString(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('transfertbudget[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Transfertbudget';
    }

}
