<?php

/**
 * Journalcomptable form base class.
 *
 * @method Journalcomptable getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseJournalcomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'code'                  => new sfWidgetFormInputText(),
      'libelle'               => new sfWidgetFormTextarea(),
      'numerotation'          => new sfWidgetFormInputText(),
      'issimule'              => new sfWidgetFormInputText(),
      'isintegrer'            => new sfWidgetFormInputText(),
      'date'                  => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'iscloture'             => new sfWidgetFormInputText(),
      'datedebutcloture'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefincloture'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'isbloque'              => new sfWidgetFormInputText(),
      'isvalide'              => new sfWidgetFormInputText(),
      'datedebutbloque'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'detefinbloque'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_type_journal'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typejournal'), 'add_empty' => true)),
      'id_comptecontrepartie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_dossier'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'id_exercice'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'                  => new sfValidatorString(array('max_length' => 15)),
      'libelle'               => new sfValidatorString(array('required' => false)),
      'numerotation'          => new sfValidatorInteger(array('required' => false)),
      'issimule'              => new sfValidatorInteger(array('required' => false)),
      'isintegrer'            => new sfValidatorInteger(array('required' => false)),
      'date'                  => new sfValidatorDate(),
      'iscloture'             => new sfValidatorInteger(array('required' => false)),
      'datedebutcloture'      => new sfValidatorDate(array('required' => false)),
      'datefincloture'        => new sfValidatorDate(array('required' => false)),
      'isbloque'              => new sfValidatorInteger(array('required' => false)),
      'isvalide'              => new sfValidatorInteger(array('required' => false)),
      'datedebutbloque'       => new sfValidatorDate(array('required' => false)),
      'detefinbloque'         => new sfValidatorDate(array('required' => false)),
      'id_type_journal'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typejournal'), 'column' => 'id', 'required' => false)),
      'id_comptecontrepartie' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'id_dossier'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'id_exercice'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journalcomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journalcomptable';
  }

}
