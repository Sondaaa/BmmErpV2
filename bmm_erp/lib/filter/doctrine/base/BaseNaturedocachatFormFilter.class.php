<?php

/**
 * Naturedocachat filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaturedocachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'    => new sfWidgetFormFilterInput(),
      'libelle' => new sfWidgetFormFilterInput(),
	   'id_user'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'    => new sfValidatorPass(array('required' => false)),
      'libelle' => new sfValidatorPass(array('required' => false)),
	   'id_user'     => new sfValidatorPass(array('required' => false)),       
    ));

    $this->widgetSchema->setNameFormat('naturedocachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naturedocachat';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'code'    => 'Text',
      'libelle' => 'Text',
    );
  }
}
