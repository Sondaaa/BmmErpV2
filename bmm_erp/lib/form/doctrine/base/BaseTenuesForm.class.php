<?php

/**
 * Tenues form base class.
 *
 * @method Tenues getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTenuesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'tache'           => new sfWidgetFormInputText(),
      'id_agents'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'observation'     => new sfWidgetFormTextarea(),
      'caracteristique' => new sfWidgetFormInputText(),
      'id_ouvrier'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'personnel'       => new sfWidgetFormInputText(),
      'date'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_typetenue'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typetenue'), 'add_empty' => true)),
      'id_typemission'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tache'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_agents'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'observation'     => new sfValidatorString(array('required' => false)),
      'caracteristique' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_ouvrier'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id', 'required' => false)),
      'personnel'       => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'date'            => new sfValidatorDate(array('required' => false)),
      'id_typetenue'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typetenue'), 'column' => 'id', 'required' => false)),
      'id_typemission'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tenues[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tenues';
  }

}
