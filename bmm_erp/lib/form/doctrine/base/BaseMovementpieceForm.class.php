<?php

/**
 * Movementpiece form base class.
 *
 * @method Movementpiece getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMovementpieceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'date'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'reference'          => new sfWidgetFormInputText(),
      'montant'            => new sfWidgetFormInputText(),
      'dateimportation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'saisie'             => new sfWidgetFormInputText(),
      'id_piececomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'             => new sfWidgetFormInputText(),
      'datevaleur'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'libelle'            => new sfWidgetFormInputText(),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_dossier'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'type'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'reference'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montant'            => new sfValidatorNumber(array('required' => false)),
      'dateimportation'    => new sfValidatorDate(array('required' => false)),
      'saisie'             => new sfValidatorInteger(array('required' => false)),
      'id_piececomptable'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id', 'required' => false)),
      'numero'             => new sfValidatorInteger(array('required' => false)),
      'datevaleur'         => new sfValidatorDate(array('required' => false)),
      'libelle'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id', 'required' => false)),
      'id_dossier'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'type'               => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movementpiece[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Movementpiece';
  }

}
