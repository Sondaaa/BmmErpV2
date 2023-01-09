<?php

/**
 * Lignedocumenttransfert form base class.
 *
 * @method Lignedocumenttransfert getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseLignedocumenttransfertForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_immo'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'id_documenttransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documenttransfert'), 'add_empty' => false)),
      'id_local1'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => false)),
      'id_local2'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux_3'), 'add_empty' => true)),
      'id_curenttransfert'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'add_empty' => true)),
      'datetransfert'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dateretur'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
     
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_immo'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'column' => 'id', 'required' => false)),
      'id_documenttransfert' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documenttransfert'), 'column' => 'id')),
      'id_local1'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
      'id_local2'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux_3'), 'column' => 'id', 'required' => false)),
      'id_curenttransfert'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'column' => 'id', 'required' => false)),
      'datetransfert'       => new sfValidatorDateTime(array('required' => false)),
      'dateretur'       => new sfValidatorDateTime(array('required' => false)),
       ));

    $this->widgetSchema->setNameFormat('lignedocumenttransfert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocumenttransfert';
  }

}
