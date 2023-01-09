<?php

/**
 * Ligneniveuxeducatif form base class.
 *
 * @method Ligneniveuxeducatif getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneniveuxeducatifForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormInputText(),
      'id_niveaueducatif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'add_empty' => true)),
      'id_agents'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_niveaueducatif' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'column' => 'id', 'required' => false)),
      'id_agents'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneniveuxeducatif[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneniveuxeducatif';
  }

}
