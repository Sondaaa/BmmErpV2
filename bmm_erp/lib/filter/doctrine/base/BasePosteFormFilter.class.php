<?php

/**
 * Poste filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePosteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'poste' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poste' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('poste_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Poste';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'poste' => 'Text',
    );
  }
}
