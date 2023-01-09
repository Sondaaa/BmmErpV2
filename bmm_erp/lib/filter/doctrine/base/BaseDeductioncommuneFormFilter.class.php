<?php

/**
 * Deductioncommune filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeductioncommuneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'designation' => new sfWidgetFormFilterInput(),
      'montant'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'designation' => new sfValidatorPass(array('required' => false)),
      'montant'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('deductioncommune_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Deductioncommune';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'designation' => 'Text',
      'montant'     => 'Number',
    );
  }
}
