<?php

/**
 * Moduleerp form base class.
 *
 * @method Moduleerp getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseModuleerpForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputHidden(),
      'nom' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('moduleerp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Moduleerp';
  }

}
