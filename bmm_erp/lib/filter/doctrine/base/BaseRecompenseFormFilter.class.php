<?php

/**
 * Recompense filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecompenseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_typerecompense' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typerecompense'), 'add_empty' => true)),
      'explication'       => new sfWidgetFormFilterInput(),
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'source'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_agents'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_typerecompense' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typerecompense'), 'column' => 'id')),
      'explication'       => new sfValidatorPass(array('required' => false)),
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'source'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recompense_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recompense';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_agents'         => 'ForeignKey',
      'id_typerecompense' => 'ForeignKey',
      'explication'       => 'Text',
      'date'              => 'Date',
      'source'            => 'Text',
    );
  }
}
