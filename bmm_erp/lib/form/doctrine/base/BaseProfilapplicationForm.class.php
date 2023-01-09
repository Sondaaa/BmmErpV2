<?php

/**
 * Profilapplication form base class.
 *
 * @method Profilapplication getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseProfilapplicationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_profil'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'add_empty' => true)),
      'id_application' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_profil'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'column' => 'id', 'required' => false)),
      'id_application' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Application'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profilapplication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profilapplication';
  }

}
