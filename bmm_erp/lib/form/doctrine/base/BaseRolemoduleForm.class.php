<?php

/**
 * Rolemodule form base class.
 *
 * @method Rolemodule getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRolemoduleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_module' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Moduleerp'), 'add_empty' => true)),
      'id_role'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => true)),
      'id_user'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_module' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Moduleerp'), 'required' => false)),
      'id_role'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'required' => false)),
      'id_user'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rolemodule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rolemodule';
  }

}
