<?php

/**
 * Profilmodule filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfilmoduleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_profilapplication' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profilapplication'), 'add_empty' => true)),
      'id_applicationmodule' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Applicationmodule'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_profilapplication' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profilapplication'), 'column' => 'id')),
      'id_applicationmodule' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Applicationmodule'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profilmodule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profilmodule';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_profilapplication' => 'ForeignKey',
      'id_applicationmodule' => 'ForeignKey',
    );
  }
}
