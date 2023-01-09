<?php

/**
 * Plancomptable form base class.
 *
 * @method Plancomptable getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlancomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'numerocompte' => new sfWidgetFormInputText(),
      'typesolde'    => new sfWidgetFormInputText(),
      'lettrage'     => new sfWidgetFormInputText(),
      'standard'     => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_classe'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classecompte'), 'add_empty' => false)),
      'id_devise'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_compte'    => new sfWidgetFormInputText(),
      'id_user'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
	   'ensommeil' => new sfWidgetFormInputText(),
	    'senspardefaut' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numerocompte' => new sfValidatorString(array('max_length' => 15)),
      'typesolde'    => new sfValidatorInteger(array('required' => false)),
      'lettrage'     => new sfValidatorInteger(array('required' => false)),
      'standard'     => new sfValidatorInteger(array('required' => false)),
      'date'         => new sfValidatorDate(),
      'id_classe'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classecompte'))),
      'id_devise'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'required' => false)),
      'id_compte'    => new sfValidatorInteger(array('required' => false)),
      'id_user'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
	  'ensommeil' => new sfValidatorString(array('max_length' => 25)),
	   'senspardefaut' => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->widgetSchema->setNameFormat('plancomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plancomptable';
  }

}
