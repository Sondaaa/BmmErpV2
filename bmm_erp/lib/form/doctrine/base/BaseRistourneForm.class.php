<?php

/**
 * Ristourne form base class.
 *
 * @method Ristourne getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseRistourneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'libelle'         => new sfWidgetFormInputText(),
      'id_sousrubrique' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_sousrubrique' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ristourne[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ristourne';
  }

}
