<?php

/**
 * Journalcentralisateur form base class.
 *
 * @method Journalcentralisateur getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseJournalcentralisateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_exercice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'id_journal'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'mois'        => new sfWidgetFormInputText(),
      'debit'       => new sfWidgetFormInputText(),
      'credit'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_exercice' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
      'id_journal'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id', 'required' => false)),
      'mois'        => new sfValidatorInteger(array('required' => false)),
      'debit'       => new sfValidatorNumber(array('required' => false)),
      'credit'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journalcentralisateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journalcentralisateur';
  }

}
