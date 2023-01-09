<?php

/**
 * Parametrenote filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametrenoteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contenue' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contenue' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametrenote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametrenote';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'contenue' => 'Text',
    );
  }
}
