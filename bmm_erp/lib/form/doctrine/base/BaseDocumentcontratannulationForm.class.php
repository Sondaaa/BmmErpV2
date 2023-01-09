<?php

/**
 * Documentcontratannulation form base class.
 *
 * @method Documentcontratannulation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDocumentcontratannulationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'dateannulation'  => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'motifannulation' => new sfWidgetFormTextarea(),
      'urldocscaner'    => new sfWidgetFormTextarea(),
      'valide_budget'   => new sfWidgetFormInputCheckbox(),
      'id_docachat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_doccontrat'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dateannulation'  => new sfValidatorDate(array('required' => false)),
      'id_user'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'motifannulation' => new sfValidatorString(array('required' => false)),
      'urldocscaner'    => new sfValidatorString(array('required' => false)),
      'valide_budget'   => new sfValidatorBoolean(array('required' => false)),
      'id_docachat'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'id_doccontrat'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentcontratannulation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentcontratannulation';
  }

}
