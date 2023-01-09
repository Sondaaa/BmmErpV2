<?php

/**
 * Pays filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaysFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pays' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pays' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pays_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pays';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'pays' => 'Text',
    );
  }
}
