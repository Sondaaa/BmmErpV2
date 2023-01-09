<?php

/**
 * Sourcesbudget filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSourcesbudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'source' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'source' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sourcesbudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sourcesbudget';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'source' => 'Text',
    );
  }
}
