<?php

/**
 * Client form base class.
 *
 * @method Client getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseClientForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'reference'        => new sfWidgetFormTextarea(),
      'nom'              => new sfWidgetFormTextarea(),
      'prenom'           => new sfWidgetFormTextarea(),
      'rs'               => new sfWidgetFormTextarea(),
      'mail'             => new sfWidgetFormTextarea(),
      'tel'              => new sfWidgetFormTextarea(),
      'gsm'              => new sfWidgetFormTextarea(),
      'id_activite'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'add_empty' => true)),
      'nfiche'           => new sfWidgetFormInputText(),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'     => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'codeclt'          => new sfWidgetFormInputText(),
      'observation'      => new sfWidgetFormTextarea(),
      'id_plancomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_dossier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference'        => new sfValidatorString(array('required' => false)),
      'nom'              => new sfValidatorString(array('required' => false)),
      'prenom'           => new sfValidatorString(array('required' => false)),
      'rs'               => new sfValidatorString(array('required' => false)),
      'mail'             => new sfValidatorString(array('required' => false)),
      'tel'              => new sfValidatorString(array('required' => false)),
      'gsm'              => new sfValidatorString(array('required' => false)),
      'id_activite'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'column' => 'id', 'required' => false)),
      'nfiche'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'datecreation'     => new sfValidatorDate(array('required' => false)),
      'codeclt'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'observation'      => new sfValidatorString(array('required' => false)),
      'id_plancomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'id_dossier'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('client[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

}
