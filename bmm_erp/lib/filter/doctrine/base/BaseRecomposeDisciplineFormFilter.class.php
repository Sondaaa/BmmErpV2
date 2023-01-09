<?php

/**
 * Recomposediscipline filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecomposedisciplineFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'source'           => new sfWidgetFormFilterInput(),
      'explication'      => new sfWidgetFormFilterInput(),
      'id_agents'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_typedecipline' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscpline'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'source'           => new sfValidatorPass(array('required' => false)),
      'explication'      => new sfValidatorPass(array('required' => false)),
      'id_agents'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_typedecipline' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typediscpline'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('recomposediscipline_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recomposediscipline';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'date'             => 'Date',
      'source'           => 'Text',
      'explication'      => 'Text',
      'id_agents'        => 'ForeignKey',
      'id_typedecipline' => 'ForeignKey',
    );
  }
}
