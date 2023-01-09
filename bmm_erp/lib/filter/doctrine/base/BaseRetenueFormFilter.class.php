<?php

/**
 * Retenue filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRetenueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'     => new sfWidgetFormFilterInput(),
      'typeretenue' => new sfWidgetFormFilterInput(),
      'id_type'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'     => new sfValidatorPass(array('required' => false)),
      'typeretenue' => new sfValidatorPass(array('required' => false)),
      'id_type'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeavancepret'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('retenue_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Retenue';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'libelle'     => 'Text',
      'typeretenue' => 'Text',
      'id_type'     => 'ForeignKey',
    );
  }
}
