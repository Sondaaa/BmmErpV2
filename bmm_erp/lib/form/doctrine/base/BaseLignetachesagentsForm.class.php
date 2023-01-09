<?php

/**
 * Lignetachesagents form base class.
 *
 * @method Lignetachesagents getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignetachesagentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_tache'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taches'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_tache'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Taches'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignetachesagents[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetachesagents';
  }

}
