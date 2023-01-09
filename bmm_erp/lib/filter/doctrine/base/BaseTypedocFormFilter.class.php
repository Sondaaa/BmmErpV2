<?php

/**
 * Typedoc filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypedocFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'         => new sfWidgetFormFilterInput(),
      'conditiontype'   => new sfWidgetFormFilterInput(),
      'valeurcondition' => new sfWidgetFormFilterInput(),
      'prefixetype'     => new sfWidgetFormFilterInput(),
      'prefixevaleur'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'conditiontype'   => new sfValidatorPass(array('required' => false)),
      'valeurcondition' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prefixetype'     => new sfValidatorPass(array('required' => false)),
      'prefixevaleur'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('typedoc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typedoc';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'libelle'         => 'Text',
      'conditiontype'   => 'Text',
      'valeurcondition' => 'Number',
      'prefixetype'     => 'Text',
      'prefixevaleur'   => 'Number',
    );
  }
}
