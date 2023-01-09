<?php

/**
 * Annexebudget form base class.
 *
 * @method Annexebudget getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnnexebudgetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'titre'        => new sfWidgetFormTextarea(),
      'nbrcolonne'   => new sfWidgetFormInputText(),
      'direction'    => new sfWidgetFormTextarea(),
      'sommation'    => new sfWidgetFormInputCheckbox(),
      'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titre'        => new sfValidatorString(array('required' => false)),
      'nbrcolonne'   => new sfValidatorInteger(array('required' => false)),
      'direction'    => new sfValidatorString(array('required' => false)),
      'sommation'    => new sfValidatorBoolean(array('required' => false)),
      'datecreation' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('annexebudget[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annexebudget';
  }

}
