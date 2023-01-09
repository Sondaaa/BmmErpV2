<?php

/**
 * Lignediplomeagents form base class.
 *
 * @method Lignediplomeagents getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignediplomeagentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'libelle'    => new sfWidgetFormInputText(),
      'annee'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_agents'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_diplome' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Diplome'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'annee'      => new sfValidatorDate(array('required' => false)),
      'id_agents'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_diplome' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Diplome'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignediplomeagents[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignediplomeagents';
  }

}
