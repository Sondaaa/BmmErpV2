<?php

/**
 * Scanner form base class.
 *
 * @method Scanner getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseScannerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputText(),
      'chaine' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorInteger(),
      'chaine' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('scanner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Scanner';
  }

}
