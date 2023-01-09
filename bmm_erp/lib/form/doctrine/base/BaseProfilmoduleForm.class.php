<?php

/**
 * Profilmodule form base class.
 *
 * @method Profilmodule getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseProfilmoduleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_profilapplication' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profilapplication'), 'add_empty' => true)),
      'id_applicationmodule' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Applicationmodule'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_profilapplication' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profilapplication'), 'column' => 'id', 'required' => false)),
      'id_applicationmodule' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Applicationmodule'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profilmodule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profilmodule';
  }

}
