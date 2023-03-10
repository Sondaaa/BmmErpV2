<?php

/**
 * Salaireouvrier filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSalaireouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
      'salaire'           => new sfWidgetFormFilterInput(),
      'datedebut'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'title'             => new sfWidgetFormFilterInput(),
      'jourferier'        => new sfWidgetFormFilterInput(),
      'id_affectation'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_contratouvrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id')),
      'salaire'           => new sfValidatorPass(array('required' => false)),
      'datedebut'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'title'             => new sfValidatorPass(array('required' => false)),
      'jourferier'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_affectation'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('salaireouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Salaireouvrier';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_contratouvrier' => 'ForeignKey',
      'salaire'           => 'Text',
      'datedebut'         => 'Date',
      'datefin'           => 'Date',
      'title'             => 'Text',
      'jourferier'        => 'Number',
      'id_affectation'    => 'Text',
    );
  }
}
