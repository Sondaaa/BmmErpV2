<?php

/**
 * Uniterepartitioncharge filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUniterepartitionchargeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'libelle'              => new sfWidgetFormFilterInput(),
      'montant'              => new sfWidgetFormFilterInput(),
      'id_repartitioncharge' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libelle'              => new sfValidatorPass(array('required' => false)),
      'montant'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_repartitioncharge' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repartitioncharge'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('uniterepartitioncharge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Uniterepartitioncharge';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'date'                 => 'Date',
      'libelle'              => 'Text',
      'montant'              => 'Number',
      'id_repartitioncharge' => 'ForeignKey',
    );
  }
}
