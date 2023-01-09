<?php

/**
 * Lignerepartitionsalaireouvrier form base class.
 *
 * @method Lignerepartitionsalaireouvrier getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignerepartitionsalaireouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'id_chantierrepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'add_empty' => true)),
      'mois'                   => new sfWidgetFormInputText(),
      'jour'                   => new sfWidgetFormInputText(),
      'montant'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_chantierrepartition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'required' => false)),
      'mois'                   => new sfValidatorInteger(array('required' => false)),
      'jour'                   => new sfValidatorInteger(array('required' => false)),
      'montant'                => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignerepartitionsalaireouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignerepartitionsalaireouvrier';
  }

}
