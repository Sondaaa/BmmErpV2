<?php

/**
 * Pret form base class.
 *
 * @method Pret getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePretForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'libelle'   => new sfWidgetFormInputText(),
      'id_source' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_source' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pret[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pret';
  }

}
