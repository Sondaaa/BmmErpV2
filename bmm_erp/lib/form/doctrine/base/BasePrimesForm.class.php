<?php

/**
 * Primes form base class.
 *
 * @method Primes getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePrimesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'description'          => new sfWidgetFormTextarea(),
      'montant'              => new sfWidgetFormInputText(),
      'salairedebase'        => new sfWidgetFormTextarea(),
      'id_categorie'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
      'id_fonction'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'add_empty' => true)),
      'id_grade'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
      'id_corpsdet'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'add_empty' => true)),
      'id_poste'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
      'id_souscorps'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'add_empty' => true)),
      'id_titreprime'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titreprimes'), 'add_empty' => true)),
      'cotisable'            => new sfWidgetFormInputCheckbox(),
      'imposable'            => new sfWidgetFormInputCheckbox(),
      'sensprime'            => new sfWidgetFormInputText(),
      'typemontant'          => new sfWidgetFormInputText(),
      'id_typeformule'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formuleprimes'), 'add_empty' => true)),
      'tenirjourfconge'      => new sfWidgetFormInputCheckbox(),
      'formule'              => new sfWidgetFormInputText(),
      'variableformule'      => new sfWidgetFormInputText(),
      'tenirhjsuppavec'      => new sfWidgetFormInputCheckbox(),
      'tenirhjsuppsans'      => new sfWidgetFormInputCheckbox(),
      'primeactiveindemnite' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'montant'              => new sfValidatorNumber(array('required' => false)),
      'salairedebase'        => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'id_categorie'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'column' => 'id', 'required' => false)),
      'id_fonction'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'column' => 'id', 'required' => false)),
      'id_grade'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'column' => 'id', 'required' => false)),
      'id_corpsdet'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'column' => 'id', 'required' => false)),
      'id_poste'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'column' => 'id', 'required' => false)),
      'id_souscorps'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'column' => 'id', 'required' => false)),
      'id_titreprime'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titreprimes'), 'column' => 'id', 'required' => false)),
      'cotisable'            => new sfValidatorBoolean(array('required' => false)),
      'imposable'            => new sfValidatorBoolean(array('required' => false)),
      'sensprime'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typemontant'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_typeformule'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formuleprimes'), 'column' => 'id', 'required' => false)),
      'tenirjourfconge'      => new sfValidatorBoolean(array('required' => false)),
      'formule'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'variableformule'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tenirhjsuppavec'      => new sfValidatorBoolean(array('required' => false)),
      'tenirhjsuppsans'      => new sfValidatorBoolean(array('required' => false)),
      'primeactiveindemnite' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('primes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Primes';
  }

}
