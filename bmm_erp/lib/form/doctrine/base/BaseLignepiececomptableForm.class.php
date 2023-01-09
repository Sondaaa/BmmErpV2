<?php

/**
 * Lignepiececomptable form base class.
 *
 * @method Lignepiececomptable getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignepiececomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'reference'          => new sfWidgetFormInputText(),
      'numeroexterne'      => new sfWidgetFormInputText(),
      'date'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montantdebit'       => new sfWidgetFormInputText(),
      'montantcredit'      => new sfWidgetFormInputText(),
      'lettrelettrage'     => new sfWidgetFormInputText(),
      'id_piececomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => false)),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_contrepartie'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'add_empty' => true)),
      'id_naturepiece'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepiece'), 'add_empty' => true)),
      'id_factureachat'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'add_empty' => true)),
	    'id_factureod'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableod'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'numeroexterne'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'montantdebit'       => new sfValidatorNumber(array('required' => false)),
      'montantcredit'      => new sfValidatorNumber(array('required' => false)),
      'lettrelettrage'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id_piececomptable'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'))),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'required' => false)),
      'id_contrepartie'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'required' => false)),
      'id_naturepiece'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepiece'), 'required' => false)),
      'id_factureachat'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'required' => false)),
    'id_factureod'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableod'), 'required' => false)),
    
   ));

    $this->widgetSchema->setNameFormat('lignepiececomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepiececomptable';
  }

}
