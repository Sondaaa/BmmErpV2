<?php

/**
 * Rolemodule filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRolemoduleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_module' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moduleerp'), 'add_empty' => true)),
      'id_role'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => true)),
      'id_user'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_module' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Moduleerp'), 'column' => 'id')),
      'id_role'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Role'), 'column' => 'id')),
      'id_user'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rolemodule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rolemodule';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_module' => 'ForeignKey',
      'id_role'   => 'ForeignKey',
      'id_user'   => 'ForeignKey',
    );
  }
}
