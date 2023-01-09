<?php

/**
 * Fraisgeneraux form base class.
 *
 * @method Fraisgeneraux getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFraisgenerauxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'annee'          => new sfWidgetFormInputText(),
      'date'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montantcharge'  => new sfWidgetFormInputText(),
      'montantproduit' => new sfWidgetFormInputText(),
      'montant'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'annee'          => new sfValidatorInteger(array('required' => false)),
      'date'           => new sfValidatorDate(array('required' => false)),
      'montantcharge'  => new sfValidatorNumber(array('required' => false)),
      'montantproduit' => new sfValidatorNumber(array('required' => false)),
      'montant'        => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fraisgeneraux[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fraisgeneraux';
  }

}
