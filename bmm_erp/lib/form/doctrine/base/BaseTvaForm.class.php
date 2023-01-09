<?php

/**
 * Tva form base class.
 *
 * @method Tva getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTvaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'libelle'   => new sfWidgetFormInputText(),
      'valeurtva' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'valeurtva' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tva[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tva';
  }

}
