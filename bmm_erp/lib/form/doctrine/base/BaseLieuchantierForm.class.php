<?php

/**
 * Lieuchantier form base class.
 *
 * @method Lieuchantier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLieuchantierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'libelle'        => new sfWidgetFormInputText(),
      'id_lieutravail' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_lieutravail' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lieuchantier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lieuchantier';
  }

}
