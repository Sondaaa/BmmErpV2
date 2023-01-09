<?php

/**
 * Baremeimpot form base class.
 *
 * @method Baremeimpot getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBaremeimpotForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'montantdebut' => new sfWidgetFormInputText(),
      'montantfin'   => new sfWidgetFormInputText(),
      'pourcentage'  => new sfWidgetFormInputText(),
      'libelle'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'montantdebut' => new sfValidatorNumber(array('required' => false)),
      'montantfin'   => new sfValidatorNumber(array('required' => false)),
      'pourcentage'  => new sfValidatorInteger(array('required' => false)),
      'libelle'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('baremeimpot[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Baremeimpot';
  }

}
