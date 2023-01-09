<?php

/**
 * Tauxammortisement form base class.
 *
 * @method Tauxammortisement getObject() Returns the current form's model object
 *
 * @package    Inventairetest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTauxammortisementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'tauxammortisement' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tauxammortisement' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tauxammortisement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tauxammortisement';
  }

}
