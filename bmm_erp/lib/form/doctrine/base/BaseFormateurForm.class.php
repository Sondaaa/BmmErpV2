<?php

/**
 * Formateur form base class.
 *
 * @method Formateur getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'cin'    => new sfWidgetFormInputText(),
      'nom'    => new sfWidgetFormInputText(),
      'prenom' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cin'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'nom'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prenom' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('formateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Formateur';
  }

}
