<?php

/**
 * Titrebudjet form base class.
 *
 * @method Titrebudjet getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTitrebudjetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'libelle'              => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'id_projet'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_direction'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'id_source'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'add_empty' => true)),
      'mntglobal'            => new sfWidgetFormInputText(),
      'id_user'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'         => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'datesignature'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'etatbudget'           => new sfWidgetFormInputText(),
      'typebudget'           => new sfWidgetFormInputText(),
      'id_titrebudget'       => new sfWidgetFormInputText(),
      'id_cat'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorietitre'), 'add_empty' => true)),
      'pourcentageencaisser' => new sfWidgetFormInputText(),
      'mntexterne'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'              => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'description'          => new sfValidatorString(array('required' => false)),
      'id_projet'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'column' => 'id', 'required' => false)),
      'id_direction'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
      'id_source'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'column' => 'id', 'required' => false)),
      'mntglobal'            => new sfValidatorNumber(array('required' => false)),
      'id_user'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'datecreation'         => new sfValidatorDate(array('required' => false)),
      'datesignature'        => new sfValidatorDate(array('required' => false)),
      'etatbudget'           => new sfValidatorInteger(array('required' => false)),
      'typebudget'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'id_titrebudget'       => new sfValidatorInteger(array('required' => false)),
      'id_cat'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categorietitre'), 'column' => 'id', 'required' => false)),
      'pourcentageencaisser' => new sfValidatorInteger(array('required' => false)),
      'mntexterne'           => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('titrebudjet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Titrebudjet';
  }

}
