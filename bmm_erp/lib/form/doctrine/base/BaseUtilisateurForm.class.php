<?php

/**
 * Utilisateur form base class.
 *
 * @method Utilisateur getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseUtilisateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'login'          => new sfWidgetFormTextarea(),
      'pwd'            => new sfWidgetFormTextarea(),
      'id_parent'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_profil'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'add_empty' => true)),
      'remember_token' => new sfWidgetFormInputText(),
      'password'       => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'is_admin'       => new sfWidgetFormInputCheckbox(),
      'is_active'      => new sfWidgetFormInputCheckbox(),
      'delated_at'     => new sfWidgetFormDateTime(),
      
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'login'          => new sfValidatorString(array('required' => false)),
      'pwd'            => new sfValidatorString(array('required' => false)),
      'id_parent'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_profil'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'column' => 'id', 'required' => false)),
      'remember_token' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'password'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'is_admin'       => new sfValidatorBoolean(array('required' => false)),
      'is_active'      => new sfValidatorBoolean(array('required' => false)),
      
      'delated_at'     => new sfValidatorDateTime(array('required' => false)),
     
    ));

    $this->widgetSchema->setNameFormat('utilisateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utilisateur';
  }

}
