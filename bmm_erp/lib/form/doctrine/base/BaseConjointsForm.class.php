<?php

/**
 * Conjoints form base class.
 *
 * @method Conjoints getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseConjointsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nom'         => new sfWidgetFormInputText(),
      'prenom'      => new sfWidgetFormInputText(),
      'etattravail' => new sfWidgetFormInputCheckbox(),
      'id_agents'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'nordre'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'prenom'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'etattravail' => new sfValidatorBoolean(array('required' => false)),
      'id_agents'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'nordre'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('conjoints[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conjoints';
  }

}
