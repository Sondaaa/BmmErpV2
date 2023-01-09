<?php

/**
 * Aidesociale form base class.
 *
 * @method Aidesociale getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAidesocialeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id'          => new sfWidgetFormInputHidden(),
      'id_agents'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'nature'      => new sfWidgetFormInputText(),
      'origine'     => new sfWidgetFormInputText(),
      'montant'     => new sfWidgetFormInputText(),
      'observation' => new sfWidgetFormTextarea(),
      'id_typeaide' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaide'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'        => new sfValidatorDate(array('required' => false)),
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'nature'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'origine'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'montant'     => new sfValidatorNumber(array('required' => false)),
      'observation' => new sfValidatorString(array('required' => false)),
      'id_typeaide' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaide'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aidesociale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aidesociale';
  }

}
