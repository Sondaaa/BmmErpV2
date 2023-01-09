<?php

/**
 * Menus form base class.
 *
 * @method Menus getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMenusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'ordre'     => new sfWidgetFormInputText(),
      'name'      => new sfWidgetFormInputText(),
      'link'      => new sfWidgetFormInputText(),
      'id_parent' => new sfWidgetFormInputText(),
      'icon'      => new sfWidgetFormInputText(),
      'classicon' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'ordre'     => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'link'      => new sfValidatorString(array('max_length' => 254)),
      'id_parent' => new sfValidatorInteger(array('required' => false)),
      'icon'      => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'classicon' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menus';
  }

}
