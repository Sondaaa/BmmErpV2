<?php

/**
 * Pvdoc form base class.
 *
 * @method Pvdoc getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePvdocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'daterenion'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datereception' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'duree'         => new sfWidgetFormInputText(),
      'numero'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'daterenion'    => new sfValidatorDate(array('required' => false)),
      'datereception' => new sfValidatorDate(array('required' => false)),
      'duree'         => new sfValidatorInteger(array('required' => false)),
      'numero'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pvdoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pvdoc';
  }

}
