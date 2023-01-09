<?php

/**
 * Grade form base class.
 *
 * @method Grade getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseGradeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'libelle'      => new sfWidgetFormInputText(),
      'id_corpsdet'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'add_empty' => true)),
      'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_corpsdet'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'column' => 'id', 'required' => false)),
      'id_categorie' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grade';
  }

}
