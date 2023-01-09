<?php

/**
 * Numeroseriejournal form base class.
 *
 * @method Numeroseriejournal getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseNumeroseriejournalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'prefixe'     => new sfWidgetFormInputText(),
      'datedebut'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefin'     => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'numerodebut' => new sfWidgetFormInputText(),
      'numerofin'   => new sfWidgetFormInputText(),
      'attendu'     => new sfWidgetFormInputText(),
      'isbloque'    => new sfWidgetFormInputText(),
      'isvalide'    => new sfWidgetFormInputText(),
      'id_journal'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'prefixe'     => new sfValidatorString(array('max_length' => 10)),
      'datedebut'   => new sfValidatorDate(),
      'datefin'     => new sfValidatorDate(),
      'numerodebut' => new sfValidatorInteger(array('required' => false)),
      'numerofin'   => new sfValidatorInteger(array('required' => false)),
      'attendu'     => new sfValidatorInteger(array('required' => false)),
      'isbloque'    => new sfValidatorInteger(array('required' => false)),
      'isvalide'    => new sfValidatorInteger(array('required' => false)),
      'id_journal'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('numeroseriejournal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Numeroseriejournal';
  }

}
