<?php

/**
 * Echelon form base class.
 *
 * @method Echelon getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEchelonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle' => new sfWidgetFormInputText(),
      'id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'libelle' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('echelon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Echelon';
  }

}
