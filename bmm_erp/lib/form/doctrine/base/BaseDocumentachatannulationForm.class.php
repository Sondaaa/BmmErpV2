<?php

/**
 * Documentachatannulation form base class.
 *
 * @method Documentachatannulation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDocumentachatannulationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'dateannulation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'motifannulation'  => new sfWidgetFormTextarea(),
      'urldocumentscan'  => new sfWidgetFormTextarea(),
      'valide_budget'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_documentachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'dateannulation'   => new sfValidatorDate(array('required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'motifannulation'  => new sfValidatorString(array('required' => false)),
      'urldocumentscan'  => new sfValidatorString(array('required' => false)),
      'valide_budget'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentachatannulation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentachatannulation';
  }

}
