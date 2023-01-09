<?php

/**
 * Ribbancaire form base class.
 *
 * @method Ribbancaire getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseRibbancaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $etats = array(
      'Actif',
      'Bloqué',
  );
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'naturebanque_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'banque_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'add_empty' => true)),
      'frs_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'rib'             => new sfWidgetFormInputText(),
      'etat'            => new sfWidgetFormChoice(array('choices' => $etats,  'expanded' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'rib'             => new sfValidatorString(array('required' => false)),
      'etat'            => new sfValidatorString(array('required' => false)),
      'banque_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'column' => 'id', 'required' => false)),
      'naturebanque_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id', 'required' => false)),
      'frs_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ribbancaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ribbancaire';
  }
}
