<?php

/**
 * Qtelignedoc form base class.
 *
 * @method Qtelignedoc getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseQtelignedocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'qtees'            => new sfWidgetFormInputText(),
      'qteep'            => new sfWidgetFormInputText(),
      'qteas'            => new sfWidgetFormInputText(),
      'qteap'            => new sfWidgetFormInputText(),
      'qteaachat'        => new sfWidgetFormInputText(),
      'qteeachat'        => new sfWidgetFormInputText(),
      'qtelivrefrs'      => new sfWidgetFormInputText(),
      'id_lignedocachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'add_empty' => true)),
      'qtedemander'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'qtees'            => new sfValidatorNumber(array('required' => false)),
      'qteep'            => new sfValidatorNumber(array('required' => false)),
      'qteas'            => new sfValidatorNumber(array('required' => false)),
      'qteap'            => new sfValidatorNumber(array('required' => false)),
      'qteaachat'        => new sfValidatorNumber(array('required' => false)),
      'qteeachat'        => new sfValidatorNumber(array('required' => false)),
      'qtelivrefrs'      => new sfValidatorNumber(array('required' => false)),
      'id_lignedocachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'required' => false)),
      'qtedemander'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('qtelignedoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Qtelignedoc';
  }

}
