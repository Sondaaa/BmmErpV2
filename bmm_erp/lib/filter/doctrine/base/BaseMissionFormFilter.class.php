<?php

/**
 * Mission filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_ouvrier'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'id_lieu'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'duree'              => new sfWidgetFormFilterInput(),
      'datesortie'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'heuresortie'        => new sfWidgetFormFilterInput(),
      'moyentransport'     => new sfWidgetFormFilterInput(),
      'mission'            => new sfWidgetFormFilterInput(),
      'reference'          => new sfWidgetFormFilterInput(),
      'logenment'          => new sfWidgetFormFilterInput(),
      'datearrive'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'heurearrive'        => new sfWidgetFormFilterInput(),
      'signatureagents'    => new sfWidgetFormFilterInput(),
      'signaturedirecteur' => new sfWidgetFormFilterInput(),
	  'cheminsignagents'   => new sfWidgetFormFilterInput(), 
	  'cheminsigndirecteur'   => new sfWidgetFormFilterInput(), 
	  'cheminsignadaf'   => new sfWidgetFormFilterInput(), 
    ));

    $this->setValidators(array(
      'id_agents'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_ouvrier'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id')),
      'id_lieu'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
      'duree'              => new sfValidatorPass(array('required' => false)),
      'datesortie'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heuresortie'        => new sfValidatorPass(array('required' => false)),
      'moyentransport'     => new sfValidatorPass(array('required' => false)),
      'mission'            => new sfValidatorPass(array('required' => false)),
      'reference'          => new sfValidatorPass(array('required' => false)),
      'logenment'          => new sfValidatorPass(array('required' => false)),
      'datearrive'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heurearrive'        => new sfValidatorPass(array('required' => false)),
      'signatureagents'    => new sfValidatorPass(array('required' => false)),
      'signaturedirecteur' => new sfValidatorPass(array('required' => false)),
    'cheminsignagents'   => new sfValidatorPass(array('required' => false)),
	   'cheminsigndirecteur'   => new sfValidatorPass(array('required' => false)),
	      'cheminsignadaf'   => new sfValidatorPass(array('required' => false)),
 ));

    $this->widgetSchema->setNameFormat('mission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mission';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_agents'          => 'ForeignKey',
      'id_ouvrier'         => 'ForeignKey',
      'id_lieu'            => 'ForeignKey',
      'duree'              => 'Text',
      'datesortie'         => 'Date',
      'heuresortie'        => 'Text',
      'moyentransport'     => 'Text',
      'mission'            => 'Text',
      'reference'          => 'Text',
      'logenment'          => 'Text',
      'datearrive'         => 'Date',
      'heurearrive'        => 'Text',
      'signatureagents'    => 'Text',
      'signaturedirecteur' => 'Text',
    );
  }
}
