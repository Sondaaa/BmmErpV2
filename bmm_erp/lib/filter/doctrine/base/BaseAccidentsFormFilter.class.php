<?php

/**
 * Accidents filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccidentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'raison'       => new sfWidgetFormFilterInput(),
      'adresse'      => new sfWidgetFormFilterInput(),
      'date'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'duree'        => new sfWidgetFormFilterInput(),
      'typehandicap' => new sfWidgetFormFilterInput(),
      'id_agents'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'type'         => new sfWidgetFormFilterInput(),
      'nbrjour'      => new sfWidgetFormFilterInput(),
      'motif'        => new sfWidgetFormFilterInput(),
      'observation'  => new sfWidgetFormFilterInput(),
	   'id_lieu'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'raison'       => new sfValidatorPass(array('required' => false)),
      'adresse'      => new sfValidatorPass(array('required' => false)),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'duree'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typehandicap' => new sfValidatorPass(array('required' => false)),
      'id_agents'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'type'         => new sfValidatorPass(array('required' => false)),
      'nbrjour'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'motif'        => new sfValidatorPass(array('required' => false)),
      'observation'  => new sfValidatorPass(array('required' => false)),
	   'id_lieu'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('accidents_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accidents';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'raison'       => 'Text',
      'adresse'      => 'Text',
      'date'         => 'Date',
      'duree'        => 'Number',
      'typehandicap' => 'Text',
      'id_agents'    => 'ForeignKey',
      'type'         => 'Text',
      'nbrjour'      => 'Number',
      'motif'        => 'Text',
      'observation'  => 'Text',
    );
  }
}
