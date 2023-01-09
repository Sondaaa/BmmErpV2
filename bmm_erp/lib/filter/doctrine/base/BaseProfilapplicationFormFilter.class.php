<?php

/**
 * Profilapplication filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfilapplicationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_profil'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'add_empty' => true)),
      'id_application' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_profil'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profil'), 'column' => 'id')),
      'id_application' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Application'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profilapplication_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profilapplication';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_profil'      => 'ForeignKey',
      'id_application' => 'ForeignKey',
    );
  }
}
