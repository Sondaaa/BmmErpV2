<?php

/**
 * Moduleerp filter form base class.
 *
 * @package    erptest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseModuleerpFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nom' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('moduleerp_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Moduleerp';
  }

  public function getFields()
  {
    return array(
      'id'  => 'Number',
      'nom' => 'Text',
    );
  }
}
