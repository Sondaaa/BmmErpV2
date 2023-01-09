<?php

/**
 * Historiquesitautionadministrative filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquesitautionadministrativeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_contrat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'datesysteme'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_typecontrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_contrat'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'datesysteme'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_typecontrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecontrat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('historiquesitautionadministrative_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquesitautionadministrative';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_contrat'     => 'ForeignKey',
      'datesysteme'    => 'Date',
      'id_typecontrat' => 'ForeignKey',
    );
  }
}
