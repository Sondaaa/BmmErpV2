<?php

/**
 * Lignepiececomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignepiececomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'          => new sfWidgetFormFilterInput(),
      'numeroexterne'      => new sfWidgetFormFilterInput(),
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montantdebit'       => new sfWidgetFormFilterInput(),
      'montantcredit'      => new sfWidgetFormFilterInput(),
      'lettrelettrage'     => new sfWidgetFormFilterInput(),
      'id_piececomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_contrepartie'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'add_empty' => true)),
      'id_naturepiece'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepiece'), 'add_empty' => true)),
      'id_factureachat'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'add_empty' => true)),
	   'id_factureod'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableod'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'reference'          => new sfValidatorPass(array('required' => false)),
      'numeroexterne'      => new sfValidatorPass(array('required' => false)),
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montantdebit'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'montantcredit'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'lettrelettrage'     => new sfValidatorPass(array('required' => false)),
      'id_piececomptable'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id')),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id')),
      'id_contrepartie'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'column' => 'id')),
      'id_naturepiece'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturepiece'), 'column' => 'id')),
      'id_factureachat'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facturecomptableachat'), 'column' => 'id')),
  'id_factureod'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facturecomptableod'), 'column' => 'id')),
      
   ));

    $this->widgetSchema->setNameFormat('lignepiececomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepiececomptable';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'reference'          => 'Text',
      'numeroexterne'      => 'Text',
      'date'               => 'Date',
      'montantdebit'       => 'Number',
      'montantcredit'      => 'Number',
      'lettrelettrage'     => 'Text',
      'id_piececomptable'  => 'ForeignKey',
      'id_comptecomptable' => 'ForeignKey',
      'id_contrepartie'    => 'ForeignKey',
      'id_naturepiece'     => 'ForeignKey',
      'id_factureachat'    => 'ForeignKey',
	   'id_factureod'    => 'ForeignKey',
    );
  }
}
