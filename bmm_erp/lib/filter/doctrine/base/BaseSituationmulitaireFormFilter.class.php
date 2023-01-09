<?php

/**
 * Situationmulitaire filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSituationmulitaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etat'              => new sfWidgetFormFilterInput(),
      'datedenutarme'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinarme'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedesignseul'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefindesignseul' => new sfWidgetFormFilterInput(),
      'id_agents'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'etat'              => new sfValidatorPass(array('required' => false)),
      'datedenutarme'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinarme'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedesignseul'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefindesignseul' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_agents'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('situationmulitaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Situationmulitaire';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'etat'              => 'Text',
      'datedenutarme'     => 'Date',
      'datefinarme'       => 'Date',
      'datedesignseul'    => 'Date',
      'datefindesignseul' => 'Number',
      'id_agents'         => 'ForeignKey',
    );
  }
}
