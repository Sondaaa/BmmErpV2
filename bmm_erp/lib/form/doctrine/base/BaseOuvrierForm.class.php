<?php

/**
 * Ouvrier form base class.
 *
 * @method Ouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseOuvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'matricule'        => new sfWidgetFormInputText(),
      'nom'              => new sfWidgetFormInputText(),
      'prenom'           => new sfWidgetFormInputText(),
      'cin'              => new sfWidgetFormInputText(),
      'idcnrps'          => new sfWidgetFormInputText(),
      'dateafficliation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'adresse'          => new sfWidgetFormInputText(),
      'datenaissance'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'rib'              => new sfWidgetFormInputText(),
      'id_gouv'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_pays'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_situation'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'add_empty' => true)),
      'id_sexe'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'add_empty' => true)),
      'nbrenfant'        => new sfWidgetFormInputText(),
      'id_lieunaissance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera_5'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'matricule'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nom'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'prenom'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cin'              => new sfValidatorInteger(array('required' => false)),
      'idcnrps'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dateafficliation' => new sfValidatorDate(array('required' => false)),
      'adresse'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datenaissance'    => new sfValidatorDate(array('required' => false)),
      'rib'              => new sfValidatorInteger(array('required' => false)),
      'id_gouv'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id', 'required' => false)),
      'id_pays'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'column' => 'id', 'required' => false)),
      'id_situation'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'column' => 'id', 'required' => false)),
      'id_sexe'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'column' => 'id', 'required' => false)),
      'nbrenfant'        => new sfValidatorInteger(array('required' => false)),
      'id_lieunaissance' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera_5'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ouvrier';
  }

}
