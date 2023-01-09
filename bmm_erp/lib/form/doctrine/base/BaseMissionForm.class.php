<?php

/**
 * Mission form base class.
 *
 * @method Mission getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'id_agents'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_ouvrier'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'cheminsignagents'    => new sfWidgetFormTextarea(),
      'cheminsigndirecteur' => new sfWidgetFormTextarea(),
      'cheminsignadaf'      => new sfWidgetFormTextarea(),
      'id_lieu'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'duree'               => new sfWidgetFormInputText(),
      'datesortie'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'heuresortie'         => new sfWidgetFormInputText(),
      'moyentransport'      => new sfWidgetFormInputText(),
      'mission'             => new sfWidgetFormInputText(),
      'reference'           => new sfWidgetFormInputText(),
      'logenment'           => new sfWidgetFormInputText(),
      'datearrive'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'heurearrive'         => new sfWidgetFormInputText(),
      'signatureagents'     => new sfWidgetFormInputText(),
      'signaturedirecteur'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_ouvrier'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id', 'required' => false)),
      'cheminsignagents'    => new sfValidatorString(array('required' => false)),
      'cheminsigndirecteur' => new sfValidatorString(array('required' => false)),
      'cheminsignadaf'      => new sfValidatorString(array('required' => false)),
      'id_lieu'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id', 'required' => false)),
      'duree'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datesortie'          => new sfValidatorDate(array('required' => false)),
      'heuresortie'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'moyentransport'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mission'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reference'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'logenment'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datearrive'          => new sfValidatorDate(array('required' => false)),
      'heurearrive'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'signatureagents'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'signaturedirecteur'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mission';
  }

}
