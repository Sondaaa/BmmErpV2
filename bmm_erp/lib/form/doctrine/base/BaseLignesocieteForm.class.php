<?php

/**
 * Lignesociete form base class.
 *
 * @method Lignesociete getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignesocieteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_societe'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'codemois'        => new sfWidgetFormInputText(),
      'libelle'         => new sfWidgetFormTextarea(),
      'moiscalendiarle' => new sfWidgetFormInputText(),
      'nordre'          => new sfWidgetFormInputText(),
      'annee'           => new sfWidgetFormInputText(),
      'nbrmois'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_societe'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'column' => 'id', 'required' => false)),
      'codemois'        => new sfValidatorInteger(array('required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 2555, 'required' => false)),
      'moiscalendiarle' => new sfValidatorInteger(array('required' => false)),
      'nordre'          => new sfValidatorInteger(array('required' => false)),
      'annee'           => new sfValidatorInteger(array('required' => false)),
      'nbrmois'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignesociete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignesociete';
  }

}
