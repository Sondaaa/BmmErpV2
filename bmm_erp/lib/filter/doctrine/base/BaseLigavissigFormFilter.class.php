<?php

/**
 * Ligavissig filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigavissigFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_visa'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_doc'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'datevisa'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'etatvalide' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_visa'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Visaachat'), 'column' => 'id')),
      'id_doc'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'datevisa'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'etatvalide' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('ligavissig_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligavissig';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_visa'    => 'ForeignKey',
      'id_doc'     => 'ForeignKey',
      'datevisa'   => 'Date',
      'etatvalide' => 'Boolean',
    );
  }
}
