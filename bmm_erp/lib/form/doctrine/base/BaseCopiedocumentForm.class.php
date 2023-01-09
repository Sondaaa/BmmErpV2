<?php

/**
 * Copiedocument form base class.
 *
 * @method Copiedocument getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCopiedocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'num'     => new sfWidgetFormInputText(),
      'type'    => new sfWidgetFormInputText(),
      'contenu' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'num'     => new sfValidatorInteger(array('required' => false)),
      'type'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contenu' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('copiedocument[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Copiedocument';
  }

}
