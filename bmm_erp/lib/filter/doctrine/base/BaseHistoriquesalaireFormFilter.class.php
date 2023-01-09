<?php

/**
 * Historiquesalaire filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquesalaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'salairebase'    => new sfWidgetFormFilterInput(),
      'datemodification' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_contrat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_salaire'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'salairebase'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'datemodification' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_contrat'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'id_salaire'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Salairedebase'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('historiquesalaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquesalaire';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'salairebase'    => 'Number',
      'datemodification' => 'Date',
      'id_contrat'       => 'ForeignKey',
      'id_salaire'       => 'ForeignKey',
    );
  }
}
