<?php

/**
 * Naturedocachat form base class.
 *
 * @method Naturedocachat getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaturedocachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'code'    => new sfWidgetFormInputText(),
      'libelle' => new sfWidgetFormInputText(),
	   'id_user'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'    => new sfValidatorString(array('required' => false)),
      'libelle' => new sfValidatorString(array('required' => false)),
	   'id_user'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naturedocachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naturedocachat';
  }

}
