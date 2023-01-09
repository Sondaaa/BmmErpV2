<?php

/**
 * Chantierrepartitionsalaireouvrier form base class.
 *
 * @method Chantierrepartitionsalaireouvrier getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseChantierrepartitionsalaireouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_repartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'add_empty' => true)),
      'libelle'        => new sfWidgetFormTextarea(),
      'montant'        => new sfWidgetFormInputText(),
      'id_projet'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'jour'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_repartition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('max_length' => 700, 'required' => false)),
      'montant'        => new sfValidatorNumber(array('required' => false)),
      'id_projet'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
      'jour'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('chantierrepartitionsalaireouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Chantierrepartitionsalaireouvrier';
  }

}
