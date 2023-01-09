<?php

/**
 * Retenuesource form base class.
 *
 * @method Retenuesource getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRetenuesourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'libelle'       => new sfWidgetFormInputText(),
      'valeurretenue' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'valeurretenue' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('retenuesource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Retenuesource';
  }

}
