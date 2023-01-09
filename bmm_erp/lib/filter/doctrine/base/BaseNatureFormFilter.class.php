<?php

/**
 * Nature filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNatureFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nature' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nature' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nature_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Nature';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'nature' => 'Text',
    );
  }
}
