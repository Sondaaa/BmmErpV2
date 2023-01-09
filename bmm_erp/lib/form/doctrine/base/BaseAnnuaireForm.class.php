<?php

/**
 * Annuaire form base class.
 *
 * @method Annuaire getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAnnuaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'tel'    => new sfWidgetFormTextarea(),
      'fax'    => new sfWidgetFormTextarea(),
      'mail'   => new sfWidgetFormTextarea(),
      'gsm'    => new sfWidgetFormTextarea(),
      'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tel'    => new sfValidatorString(array('required' => false)),
      'fax'    => new sfValidatorString(array('required' => false)),
      'mail'   => new sfValidatorString(array('required' => false)),
      'gsm'    => new sfValidatorString(array('required' => false)),
      'id_frs' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('annuaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annuaire';
  }

}
