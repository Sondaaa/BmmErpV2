<?php

/**
 * Marque filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMarqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'marque' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'marque' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('marque_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Marque';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'marque' => 'Text',
    );
  }
}
