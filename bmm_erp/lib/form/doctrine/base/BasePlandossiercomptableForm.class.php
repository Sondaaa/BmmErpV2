<?php

/**
 * Plandossiercomptable form base class.
 *
 * @method Plandossiercomptable getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlandossiercomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'date'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'libelle'        => new sfWidgetFormTextarea(),
      'numerocompte'   => new sfWidgetFormInputText(),
      'typesolde'      => new sfWidgetFormInputText(),
      'lettrage'       => new sfWidgetFormInputText(),
      'lettrelettrage' => new sfWidgetFormInputText(),
      'solde'          => new sfWidgetFormInputText(),
	   'soldeouv'          => new sfWidgetFormInputText(),
      'id_dossier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
	    'ensommeil' => new sfWidgetFormInputText(),
      'id_plan'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
	   'senspardefaut'  => new sfWidgetFormTextarea(),
      'id_devise'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'           => new sfValidatorDate(),
      'libelle'        => new sfValidatorString(),
      'numerocompte'   => new sfValidatorString(array('max_length' => 15)),
      'typesolde'      => new sfValidatorInteger(array('required' => false)),
      'lettrage'       => new sfValidatorInteger(array('required' => false)),
      'lettrelettrage' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'solde'          => new sfValidatorNumber(array('required' => false)),
      'soldeouv'          => new sfValidatorNumber(array('required' => false)),
	 'id_dossier'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'required' => false)),
	  'ensommeil' => new sfValidatorString(array('max_length' => 25)),
      'id_plan'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'required' => false)),
	   'senspardefaut'  => new sfValidatorString(array('required' => false)),
      'id_devise'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plandossiercomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plandossiercomptable';
  }

}
