<?php

/**
 * Piececomptable form base class.
 *
 * @method Piececomptable getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePiececomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'numero'              => new sfWidgetFormInputText(),
      'libelle'             => new sfWidgetFormTextarea(),
      'date'                => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'totaldebit'          => new sfWidgetFormInputText(),
      'totalcredit'         => new sfWidgetFormInputText(),
      'reserve'             => new sfWidgetFormInputText(),
      'editable'            => new sfWidgetFormInputText(),
      'id_journalcomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'id_serie'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Numeroseriejournal'), 'add_empty' => true)),
      'id_user'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_piecesource'      => new sfWidgetFormInputText(),
      'id_exercice'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'dateliberation'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'liberer'             => new sfWidgetFormInputText(),
      'anciennumero'        => new sfWidgetFormInputText(),
      'daterenumerotation'  => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_devise'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'              => new sfValidatorString(array('max_length' => 20)),
      'libelle'             => new sfValidatorString(array('required' => false)),
      'date'                => new sfValidatorDate(array('required' => false)),
      'totaldebit'          => new sfValidatorNumber(array('required' => false)),
      'totalcredit'         => new sfValidatorNumber(array('required' => false)),
      'reserve'             => new sfValidatorInteger(array('required' => false)),
      'editable'            => new sfValidatorInteger(array('required' => false)),
      'id_journalcomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id', 'required' => false)),
      'id_serie'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Numeroseriejournal'), 'column' => 'id', 'required' => false)),
      'id_user'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'datecreation'        => new sfValidatorDate(array('required' => false)),
      'id_piecesource'      => new sfValidatorInteger(array('required' => false)),
      'id_exercice'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
      'dateliberation'      => new sfValidatorDate(array('required' => false)),
      'liberer'             => new sfValidatorInteger(array('required' => false)),
      'anciennumero'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'daterenumerotation'  => new sfValidatorDate(array('required' => false)),
      'id_devise'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('piececomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Piececomptable';
  }

}
