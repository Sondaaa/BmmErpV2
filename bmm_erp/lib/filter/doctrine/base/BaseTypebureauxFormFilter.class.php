<?php

/**
 * Typebureaux filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypebureauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typebureaux' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'typebureaux' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typebureaux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typebureaux';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'typebureaux' => 'Text',
    );
  }
}
