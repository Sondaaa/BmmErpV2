<?php

/**
 * Modescourrier filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseModescourrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mode' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mode' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modescourrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modescourrier';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'mode' => 'Text',
    );
  }
}
