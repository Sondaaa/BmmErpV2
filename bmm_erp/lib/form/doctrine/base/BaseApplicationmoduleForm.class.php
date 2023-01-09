<?php

/**
 * Applicationmodule form base class.
 *
 * @method Applicationmodule getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseApplicationmoduleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'libelle'        => new sfWidgetFormTextarea(),
      'id_application' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('required' => false)),
      'id_application' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('applicationmodule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Applicationmodule';
  }

}
