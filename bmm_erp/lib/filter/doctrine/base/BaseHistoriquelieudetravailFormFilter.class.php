<?php

/**
 * Historiquelieudetravail filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquelieudetravailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_lieu'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'datesyteme' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_contrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'id_lieu'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
      'datesyteme' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('historiquelieudetravail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquelieudetravail';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_contrat' => 'ForeignKey',
      'id_lieu'    => 'ForeignKey',
      'datesyteme' => 'Date',
    );
  }
}
