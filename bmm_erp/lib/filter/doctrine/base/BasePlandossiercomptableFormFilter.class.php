<?php

/**
 * Plandossiercomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlandossiercomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'libelle'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numerocompte'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typesolde'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lettrage'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lettrelettrage' => new sfWidgetFormFilterInput(),
      'solde'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
	  'soldeouv'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_dossier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
	   'ensommeil' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_plan'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libelle'        => new sfValidatorPass(array('required' => false)),
	   'ensommeil' => new sfValidatorPass(array('required' => false)),
      'numerocompte'   => new sfValidatorPass(array('required' => false)),
      'typesolde'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lettrage'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lettrelettrage' => new sfValidatorPass(array('required' => false)),
      'solde'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  'soldeouv'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_dossier'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'id_plan'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('plandossiercomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plandossiercomptable';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'date'           => 'Date',
      'libelle'        => 'Text',
      'numerocompte'   => 'Text',
      'typesolde'      => 'Number',
      'lettrage'       => 'Number',
      'lettrelettrage' => 'Text',
      'solde'          => 'Number',
	  'soldeouv'          => 'Number',
      'id_dossier'     => 'ForeignKey',
      'id_plan'        => 'ForeignKey',
    );
  }
}
