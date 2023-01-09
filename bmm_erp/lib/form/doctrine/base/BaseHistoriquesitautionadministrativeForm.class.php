<?php

/**
 * Historiquesitautionadministrative form base class.
 *
 * @method Historiquesitautionadministrative getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseHistoriquesitautionadministrativeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_contrat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'datesysteme'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_typecontrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contrat'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'column' => 'id', 'required' => false)),
      'datesysteme'    => new sfValidatorDate(array('required' => false)),
      'id_typecontrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquesitautionadministrative[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquesitautionadministrative';
  }

}
