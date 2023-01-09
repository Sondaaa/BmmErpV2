<?php

/**
 * Uniterepartitioncharge form base class.
 *
 * @method Uniterepartitioncharge getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUniterepartitionchargeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'date'                 => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'libelle'              => new sfWidgetFormInputText(),
      'montant'              => new sfWidgetFormInputText(),
      'id_repartitioncharge' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                 => new sfValidatorDate(array('required' => false)),
      'libelle'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montant'              => new sfValidatorNumber(array('required' => false)),
      'id_repartitioncharge' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitioncharge'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('uniterepartitioncharge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Uniterepartitioncharge';
  }

}
