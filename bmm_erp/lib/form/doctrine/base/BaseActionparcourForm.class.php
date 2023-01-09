<?php

/**
 * Actionparcour form base class.
 *
 * @method Actionparcour getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseActionparcourForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'action'   => new sfWidgetFormTextarea(),
      'remarque' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'action'   => new sfValidatorString(array('required' => false)),
      'remarque' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('actionparcour[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actionparcour';
  }

}
