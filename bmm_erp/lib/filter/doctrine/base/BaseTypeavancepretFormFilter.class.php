<?php

/**
 * Typeavancepret filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeavancepretFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle' => new sfWidgetFormFilterInput(),
      'type'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle' => new sfValidatorPass(array('required' => false)),
      'type'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeavancepret_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeavancepret';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'libelle' => 'Text',
      'type'    => 'Text',
    );
  }
}
