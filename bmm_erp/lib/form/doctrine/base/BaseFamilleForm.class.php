<?php

/**
 * Famille form base class.
 *
 * @method Famille getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseFamilleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'famille'        => new sfWidgetFormTextarea(),
      'id_categorie'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'add_empty' => true)),
      'description'    => new sfWidgetFormTextarea(),
      'id_typefamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typefamille'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'famille'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'id_categorie'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'column' => 'id', 'required' => false)),
      'description'    => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'id_typefamille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typefamille'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('famille[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Famille';
  }

}
