<?php

/**
 * Historiquepromotion filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquepromotionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dateeffet'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dategrade'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_contrat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'datesysteme' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'grade'       => new sfWidgetFormFilterInput(),
      'id_nature'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'dateeffet'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dategrade'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_contrat'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'datesysteme' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'grade'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_nature'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturepromotion'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('historiquepromotion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquepromotion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'dateeffet'   => 'Date',
      'dategrade'   => 'Date',
      'id_contrat'  => 'ForeignKey',
      'datesysteme' => 'Date',
      'grade'       => 'Number',
      'id_nature'   => 'ForeignKey',
    );
  }
}
