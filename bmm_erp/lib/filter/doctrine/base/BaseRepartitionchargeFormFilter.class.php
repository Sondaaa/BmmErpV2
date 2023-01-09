<?php

/**
 * Repartitioncharge filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRepartitionchargeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'annee'        => new sfWidgetFormFilterInput(),
      'montant'      => new sfWidgetFormFilterInput(),
      'main'         => new sfWidgetFormFilterInput(),
      'intrant'      => new sfWidgetFormFilterInput(),
      'mecanisation' => new sfWidgetFormFilterInput(),
      'jour'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'annee'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montant'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'main'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'intrant'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mecanisation' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'jour'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('repartitioncharge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Repartitioncharge';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'date'         => 'Date',
      'annee'        => 'Number',
      'montant'      => 'Number',
      'main'         => 'Number',
      'intrant'      => 'Number',
      'mecanisation' => 'Number',
      'jour'         => 'Number',
    );
  }
}
