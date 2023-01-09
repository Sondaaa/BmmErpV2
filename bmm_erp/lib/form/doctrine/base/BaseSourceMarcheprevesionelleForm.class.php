<?php

/**
 * SourceMarcheprevesionelle form base class.
 *
 * @method SourceMarcheprevesionelle getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseSourceMarcheprevesionelleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormInputText(),
      'id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('required' => false)),
      'id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('source_marcheprevesionelle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SourceMarcheprevesionelle';
  }

}
