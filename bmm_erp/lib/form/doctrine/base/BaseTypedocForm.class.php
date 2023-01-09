<?php

/**
 * Typedoc form base class.
 *
 * @method Typedoc getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTypedocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'libelle'         => new sfWidgetFormInputText(),
      'conditiontype'   => new sfWidgetFormInputText(),
      'valeurcondition' => new sfWidgetFormInputText(),
      'prefixetype'     => new sfWidgetFormInputText(),
      'prefixevaleur'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'conditiontype'   => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'valeurcondition' => new sfValidatorInteger(array('required' => false)),
      'prefixetype'     => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'prefixevaleur'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typedoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typedoc';
  }

}
