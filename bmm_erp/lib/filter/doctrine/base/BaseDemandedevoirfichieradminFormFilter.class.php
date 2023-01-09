<?php

/**
 * Demandedevoirfichieradmin filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandedevoirfichieradminFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_service'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
      'document'           => new sfWidgetFormFilterInput(),
      'datedevue'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_copie'           => new sfWidgetFormFilterInput(),
      'personne'           => new sfWidgetFormFilterInput(),
      'signatureagents'    => new sfWidgetFormFilterInput(),
      'signaturedirecteur' => new sfWidgetFormFilterInput(),
	  'cheminagents'   => new sfWidgetFormFilterInput(), 
	  'chemindirecteu'   => new sfWidgetFormFilterInput(),
	   'id_demandeur'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_agents'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_service'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Servicerh'), 'column' => 'id')),
      'document'           => new sfValidatorPass(array('required' => false)),
      'datedevue'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_copie'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'personne'           => new sfValidatorPass(array('required' => false)),
      'signatureagents'    => new sfValidatorPass(array('required' => false)),
      'signaturedirecteur' => new sfValidatorPass(array('required' => false)),
	  'cheminagents'   => new sfValidatorPass(array('required' => false)),
	      'chemindirecteu'   => new sfValidatorPass(array('required' => false)),
		    'id_demandeur'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents_3'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('demandedevoirfichieradmin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandedevoirfichieradmin';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_agents'          => 'ForeignKey',
      'id_service'         => 'ForeignKey',
      'document'           => 'Text',
      'datedevue'          => 'Date',
      'id_copie'           => 'Number',
      'personne'           => 'Text',
      'signatureagents'    => 'Text',
      'signaturedirecteur' => 'Text',
	   'cheminagents'       => 'Text',
      'chemindirecteu'     => 'Text',
      'id_demandeur'       => 'ForeignKey',
    );
  }
}
