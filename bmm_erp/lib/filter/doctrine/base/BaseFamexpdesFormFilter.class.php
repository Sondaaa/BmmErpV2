<?php

/**
 * Famexpdes filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFamexpdesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'famille' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'famille' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('famexpdes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Famexpdes';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'famille' => 'Text',
    );
  }
}
