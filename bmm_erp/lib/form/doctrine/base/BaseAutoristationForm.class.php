<?php

/**
 * Autoristation form base class.
 *
 * @method Autoristation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAutoristationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'id_agents'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_hopital'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'add_empty' => true)),
      'hopital'             => new sfWidgetFormInputText(),
      'date'                => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'cheminsignagents'    => new sfWidgetFormTextarea(),
      'cheminsigndirecteur' => new sfWidgetFormTextarea(),
      'cheminmedecin'       => new sfWidgetFormTextarea(),
      'moyen'               => new sfWidgetFormInputText(),
      'causedevisite'       => new sfWidgetFormInputText(),
      'reference'           => new sfWidgetFormInputText(),
      'signatureagents'     => new sfWidgetFormInputText(),
      'visamedecin'         => new sfWidgetFormInputText(),
      'signaturedirecteur'  => new sfWidgetFormInputText(),
      'decision'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_hopital'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'column' => 'id', 'required' => false)),
      'hopital'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date'                => new sfValidatorDate(array('required' => false)),
      'cheminsignagents'    => new sfValidatorString(array('required' => false)),
      'cheminsigndirecteur' => new sfValidatorString(array('required' => false)),
      'cheminmedecin'       => new sfValidatorString(array('required' => false)),
      'moyen'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'causedevisite'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reference'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'signatureagents'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'visamedecin'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'signaturedirecteur'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'decision'            => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('autoristation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Autoristation';
  }

}
