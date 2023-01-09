<?php

/**
 * Declaration form base class.
 *
 * @method Declaration getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDeclarationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'libelle'   => new sfWidgetFormInputText(),
      'datedebut' => new sfWidgetFormInputText(array('type' => 'date')),
      'datefin'   => new sfWidgetFormInputText(array('type' => 'date')),
      'montant'   => new sfWidgetFormInputText(),
      'etat'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'datedebut' => new sfValidatorDate(array('required' => false)),
      'datefin'   => new sfValidatorDate(array('required' => false)),
      'montant'   => new sfValidatorNumber(array('required' => false)),
      'etat'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('declaration[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Declaration';
  }

}
