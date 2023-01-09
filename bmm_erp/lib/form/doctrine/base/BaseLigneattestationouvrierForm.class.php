<?php

/**
 * Ligneattestationouvrier form base class.
 *
 * @method Ligneattestationouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneattestationouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_ouvrier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'id_attestation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Attestationouvrier'), 'add_empty' => true)),
      'nordre'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_ouvrier'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id', 'required' => false)),
      'id_attestation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Attestationouvrier'), 'column' => 'id', 'required' => false)),
      'nordre'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneattestationouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneattestationouvrier';
  }

}
