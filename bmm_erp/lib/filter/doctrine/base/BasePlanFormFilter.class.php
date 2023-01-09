<?php

/**
 * Plan filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlanFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_planing'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'datedebut'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefi'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montanthtt'   => new sfWidgetFormFilterInput(),
      'montanttc'    => new sfWidgetFormFilterInput(),
      'id_organisme' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organisme'), 'add_empty' => true)),
      'id_formateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_planing'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Planing'), 'column' => 'id')),
      'datedebut'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefi'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montanthtt'   => new sfValidatorPass(array('required' => false)),
      'montanttc'    => new sfValidatorPass(array('required' => false)),
      'id_organisme' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organisme'), 'column' => 'id')),
      'id_formateur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formateur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('plan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plan';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_planing'   => 'ForeignKey',
      'datedebut'    => 'Date',
      'datefi'       => 'Date',
      'montanthtt'   => 'Text',
      'montanttc'    => 'Text',
      'id_organisme' => 'ForeignKey',
      'id_formateur' => 'ForeignKey',
    );
  }
}
