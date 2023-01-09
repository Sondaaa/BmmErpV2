<?php

/**
 * Parametragesociete form base class.
 *
 * @method Parametragesociete getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParametragesocieteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'valeurfodec' => new sfWidgetFormInputText(),
      'id_societe'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'timbre'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'valeurfodec' => new sfValidatorNumber(array('required' => false)),
      'id_societe'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'required' => false)),
      'timbre'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametragesociete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametragesociete';
  }

}
