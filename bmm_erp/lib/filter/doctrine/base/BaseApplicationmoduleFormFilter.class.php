<?php

/**
 * Applicationmodule filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseApplicationmoduleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'        => new sfWidgetFormFilterInput(),
      'id_application' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'id_application' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Application'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('applicationmodule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Applicationmodule';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'libelle'        => 'Text',
      'id_application' => 'ForeignKey',
    );
  }
}
