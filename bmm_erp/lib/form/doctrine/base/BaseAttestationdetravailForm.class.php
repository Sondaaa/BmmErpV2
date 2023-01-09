<?php

/**
 * Attestationdetravail form base class.
 *
 * @method Attestationdetravail getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAttestationdetravailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_lieu'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'id'        => new sfWidgetFormInputHidden(),
      'cause'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_lieu'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id', 'required' => false)),
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cause'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attestationdetravail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attestationdetravail';
  }

}
