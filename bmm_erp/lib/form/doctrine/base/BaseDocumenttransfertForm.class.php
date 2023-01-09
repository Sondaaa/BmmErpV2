<?php

/**
 * Documenttransfert form base class.
 *
 * @method Documenttransfert getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseDocumenttransfertForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'libelle'          => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datevalidation'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'updated_at'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_typetransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'add_empty' => true)),
      'etat_transfert'   =>new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'type'=>      new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'          => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'datevalidation'       => new sfValidatorDateTime(array('required' => false)),
      
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'id_typetransfert' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'column' => 'id', 'required' => false)),
      'etat_transfert'   => new sfValidatorString(array('required' => false)),
      'description'      =>  new sfValidatorString(array('required' => false)),
      'type'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documenttransfert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documenttransfert';
  }

}
