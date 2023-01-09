<?php

/**
 * Attestationouvrier form base class.
 *
 * @method Attestationouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAttestationouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_chantier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
      'id_direction'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'id_service'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
      'id_unite'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
      'budget'            => new sfWidgetFormInputText(),
      'porte'             => new sfWidgetFormInputText(),
      'datedebut'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefin'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_ouvrier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_chantier'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'column' => 'id', 'required' => false)),
      'id_direction'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
      'id_service'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'column' => 'id', 'required' => false)),
      'id_unite'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'column' => 'id', 'required' => false)),
      'budget'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'porte'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datedebut'         => new sfValidatorDate(array('required' => false)),
      'datefin'           => new sfValidatorDate(array('required' => false)),
      'id_ouvrier'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id', 'required' => false)),
      'id_contratouvrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attestationouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attestationouvrier';
  }

}
