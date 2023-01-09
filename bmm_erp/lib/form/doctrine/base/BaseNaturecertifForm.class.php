<?php

/**
 * Naturecertif form base class.
 *
 * @method Naturecertif getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaturecertifForm extends BaseFormDoctrine
{
  public function setup()
  {
         $array = array(" Traitement Complet" => "Traitement Complet", "Demi-Traitement"=>"Demi-Traitement");
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'libelle'        => new sfWidgetFormInputText(),
      'nbrjour'        => new sfWidgetFormInputText(),
      'typetraitement' => new sfWidgetFormChoice(array('choices' => $array)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nbrjour'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typetraitement' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naturecertif[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naturecertif';
  }

}
