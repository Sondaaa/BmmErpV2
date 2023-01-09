<?php

/**
 * Exercice filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExerciceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date_debut' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_fin'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'type'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'    => new sfValidatorPass(array('required' => false)),
      'date_debut' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_fin'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'type'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Exercice';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'libelle'    => 'Text',
      'date_debut' => 'Date',
      'date_fin'   => 'Date',
      'type'       => 'Text',
    );
  }
}
