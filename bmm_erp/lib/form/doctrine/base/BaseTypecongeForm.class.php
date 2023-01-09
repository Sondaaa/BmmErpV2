<?php

/**
 * Typeconge form base class.
 *
 * @method Typeconge getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTypecongeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'libelle'        => new sfWidgetFormInputText(),
      'nbrjour'        => new sfWidgetFormInputText(),
      'modalitecalcul' => new sfWidgetFormInputText(),
      'paye'           => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nbrjour'        => new sfValidatorInteger(array('required' => false)),
      'modalitecalcul' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'paye'           => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeconge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeconge';
  }

}
