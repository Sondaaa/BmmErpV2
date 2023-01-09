<?php

/**
 * Actionparcour filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActionparcourFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'action'   => new sfWidgetFormFilterInput(),
      'remarque' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'action'   => new sfValidatorPass(array('required' => false)),
      'remarque' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('actionparcour_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actionparcour';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'action'   => 'Text',
      'remarque' => 'Text',
    );
  }
}
