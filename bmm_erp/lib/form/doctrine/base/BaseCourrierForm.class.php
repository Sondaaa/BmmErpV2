<?php

/**
 * Courrier form base class.
 *
 * @method Courrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCourrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'titre'                => new sfWidgetFormTextarea(),
      'object'               => new sfWidgetFormTextarea(),
      'sujet'                => new sfWidgetFormTextarea(),
      'description'          => new sfWidgetFormTextarea(),
      'id_user'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_mode'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modescourrier'), 'add_empty' => true)),
      'datecreation'         => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'id_bureaux'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
      'id_type'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
      'id_courrier'          => new sfWidgetFormInputText(),
      'numero'               => new sfWidgetFormInputText(),
      'id_famille'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillecourrier'), 'add_empty' => true)),
      'id_affectation'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Affectaioncourrier'), 'add_empty' => true)),
      'referencecourrier'    => new sfWidgetFormInputText(),
      'datereponse'          =>  new sfWidgetFormInputText(array(),array('type'=>'date')),
      'id_typeparamcourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeparamcourrier'), 'add_empty' => true)),
      'datecorespondanse'    => new sfWidgetFormInputText(),
      'numeroseq'            => new sfWidgetFormInputText(),
      'dateredige'           => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'id_famexpdes'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
      'lire'                 => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titre'                => new sfValidatorString(array('required' => false)),
      'object'               => new sfValidatorString(array('required' => false)),
      'sujet'                => new sfValidatorString(array('required' => false)),
      'description'          => new sfValidatorString(array('required' => false)),
      'id_user'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'id_mode'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modescourrier'), 'column' => 'id', 'required' => false)),
      'datecreation'         => new sfValidatorDate(array('required' => false)),
      'id_bureaux'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id', 'required' => false)),
      'id_type'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'column' => 'id', 'required' => false)),
      'id_courrier'          => new sfValidatorInteger(array('required' => false)),
      'numero'               => new sfValidatorNumber(array('required' => false)),
      'id_famille'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famillecourrier'), 'column' => 'id', 'required' => false)),
      'id_affectation'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Affectaioncourrier'), 'column' => 'id', 'required' => false)),
      'referencecourrier'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'datereponse'          => new sfValidatorDate(array('required' => false)),
      'id_typeparamcourrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeparamcourrier'), 'column' => 'id', 'required' => false)),
      'datecorespondanse'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'numeroseq'            => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'dateredige'           => new sfValidatorDate(array('required' => false)),
      'id_famexpdes'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id', 'required' => false)),
      'lire'                 => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('courrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courrier';
  }

}
