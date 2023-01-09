<?php

/**
 * Primes filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePrimesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'   => new sfWidgetFormFilterInput(),
      'montant'       => new sfWidgetFormFilterInput(),
      'salairedebase' => new sfWidgetFormFilterInput(),
      'id_categorie'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
      'id_fonction'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'add_empty' => true)),
      'id_grade'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
      'id_corpsdet'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'add_empty' => true)),
      'id_poste'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
      'id_souscorps'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'add_empty' => true)),
  'id_titreprime' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titreprimes'), 'add_empty' => true)),
  'cotisable'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'imposable'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
	  'sensprime'      => new sfWidgetFormFilterInput(),
      'typemontant'    => new sfWidgetFormFilterInput(),
      'id_typeformule' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formuleprimes'), 'add_empty' => true)),
	  'tenirjourfconge' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'formule'         => new sfWidgetFormFilterInput(),
      'variableformule' => new sfWidgetFormFilterInput(),
	  'tenirhjsuppavec'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tenirhjsuppsans'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'primeactiveindemnite' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
         ));

    $this->setValidators(array(
      'description'   => new sfValidatorPass(array('required' => false)),
      'montant'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'salairedebase' => new sfValidatorPass(array('required' => false)),
      'id_categorie'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorierh'), 'column' => 'id')),
      'id_fonction'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fonction'), 'column' => 'id')),
      'id_grade'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grade'), 'column' => 'id')),
      'id_corpsdet'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Corpsdet'), 'column' => 'id')),
      'id_poste'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posterh'), 'column' => 'id')),
      'id_titreprime' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titreprimes'), 'column' => 'id')),
	   'cotisable'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'imposable'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
	   'sensprime'      => new sfValidatorPass(array('required' => false)),
      'typemontant'    => new sfValidatorPass(array('required' => false)),
      'id_typeformule' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formuleprimes'), 'column' => 'id')),
	    'tenirjourfconge' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'formule'         => new sfValidatorPass(array('required' => false)),
      'variableformule' => new sfValidatorPass(array('required' => false)),
	  'tenirhjsuppavec'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tenirhjsuppsans'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'primeactiveindemnite' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

    $this->widgetSchema->setNameFormat('primes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Primes';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'description'   => 'Text',
      'montant'       => 'Number',
      'salairedebase' => 'Text',
      'id_categorie'  => 'ForeignKey',
      'id_fonction'   => 'ForeignKey',
      'id_grade'      => 'ForeignKey',
      'id_corpsdet'   => 'ForeignKey',
      'id_poste'      => 'ForeignKey',
      'id_souscorps'  => 'ForeignKey',
        'id_titreprime' => 'ForeignKey',
		'cotisable'      => 'Boolean',
      'imposable'      => 'Boolean',
      'sensprime'      => 'Text',
      'typemontant'    => 'Text',
      'id_typeformule' => 'ForeignKey',
    );
  }
}
