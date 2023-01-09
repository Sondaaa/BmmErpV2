<?php

/**
 * Lignedocpv filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignedocpvFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pv'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
      'id_doc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_pv'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pvdoc'), 'column' => 'id')),
      'id_doc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignedocpv_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocpv';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'id_pv'  => 'ForeignKey',
      'id_doc' => 'ForeignKey',
    );
  }
}
