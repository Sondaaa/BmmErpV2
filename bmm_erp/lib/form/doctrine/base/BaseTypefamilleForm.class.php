<?php

/**
 * Typefamille form base class.
 *
 * @method Typefamille getObject() Returns the current form's model object
 *
 * @package    InventaireTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTypefamilleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'code'    => new sfWidgetFormInputText(),
      'libelle' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'    => new sfValidatorInteger(array('required' => false)),
      'libelle' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typefamille[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typefamille';
  }

}
