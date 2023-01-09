<?php

/**
 * Repartitioncharge form base class.
 *
 * @method Repartitioncharge getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseRepartitionchargeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'date'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'annee'        => new sfWidgetFormInputText(),
      'montant'      => new sfWidgetFormInputText(),
      'main'         => new sfWidgetFormInputText(),
      'intrant'      => new sfWidgetFormInputText(),
      'mecanisation' => new sfWidgetFormInputText(),
      'jour'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'         => new sfValidatorDate(array('required' => false)),
      'annee'        => new sfValidatorInteger(array('required' => false)),
      'montant'      => new sfValidatorNumber(array('required' => false)),
      'main'         => new sfValidatorNumber(array('required' => false)),
      'intrant'      => new sfValidatorNumber(array('required' => false)),
      'mecanisation' => new sfValidatorNumber(array('required' => false)),
      'jour'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('repartitioncharge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Repartitioncharge';
  }

}
