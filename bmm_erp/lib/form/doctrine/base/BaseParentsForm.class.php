<?php

/**
 * Parents form base class.
 *
 * @method Parents getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseParentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'nom'           => new sfWidgetFormInputText(),
      'prenom'        => new sfWidgetFormInputText(),
      'datenaissance' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_agents'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'observtaion'   => new sfWidgetFormInputText(),
      'nordre'        => new sfWidgetFormInputText(),
      'etat'          => new sfWidgetFormInputCheckbox(),
      'id_bureau'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'prenom'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'datenaissance' => new sfValidatorDate(array('required' => false)),
      'id_agents'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'observtaion'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nordre'        => new sfValidatorInteger(array('required' => false)),
      'etat'          => new sfValidatorBoolean(array('required' => false)),
      'id_bureau'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parents[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parents';
  }

}
