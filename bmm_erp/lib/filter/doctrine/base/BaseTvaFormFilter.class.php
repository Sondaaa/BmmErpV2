<?php

/**
 * Tva filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTvaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'   => new sfWidgetFormFilterInput(),
      'valeurtva' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'   => new sfValidatorPass(array('required' => false)),
      'valeurtva' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tva_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tva';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'libelle'   => 'Text',
      'valeurtva' => 'Number',
    );
  }
}
