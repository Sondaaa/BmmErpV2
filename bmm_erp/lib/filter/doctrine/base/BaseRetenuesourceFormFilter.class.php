<?php

/**
 * Retenuesource filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRetenuesourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'       => new sfWidgetFormFilterInput(),
      'valeurretenue' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'       => new sfValidatorPass(array('required' => false)),
      'valeurretenue' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('retenuesource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Retenuesource';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'libelle'       => 'Text',
      'valeurretenue' => 'Number',
    );
  }
}
