<?php

/**
 * Paie filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_codesociale'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
      'id_contribution'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'id_bareme'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Baremeimpot'), 'add_empty' => true)),
      'id_historiqueretenue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Historiqueretenue'), 'add_empty' => true)),
      'mois'                 => new sfWidgetFormFilterInput(),
      'annee'                => new sfWidgetFormFilterInput(),
      'assurance'            => new sfWidgetFormFilterInput(),
      'irpp'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cnss'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'salairebrut'          => new sfWidgetFormFilterInput(),
      'netsociale'           => new sfWidgetFormFilterInput(),
      'abattement'           => new sfWidgetFormFilterInput(),
      'abattementfraaisprof' => new sfWidgetFormFilterInput(),
      'abattementenfant'     => new sfWidgetFormFilterInput(),
      'abatementcheffamille' => new sfWidgetFormFilterInput(),
      'salaireimposable'     => new sfWidgetFormFilterInput(),
      'imposablemensuel'     => new sfWidgetFormFilterInput(),
      'retenueimposable'     => new sfWidgetFormFilterInput(),
      'salairenet'           => new sfWidgetFormFilterInput(),
      'totalacompte'         => new sfWidgetFormFilterInput(),
      'totalretenue'         => new sfWidgetFormFilterInput(),
      'netapayyer'           => new sfWidgetFormFilterInput(),
	   'tfp'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'foprolos'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
	  'id_dossier'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
	  'id_annepaie'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
	    'salairedebase'        => new sfWidgetFormFilterInput(),
      'contribitionsociale'  => new sfWidgetFormFilterInput(),
	     'id_contrat'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
		  'nbrjtravaille'        => new sfWidgetFormFilterInput(),
      'nbrjconge'            => new sfWidgetFormFilterInput(),
      'nbabscenceir'         => new sfWidgetFormFilterInput(),
	  'nbrjf'                => new sfWidgetFormFilterInput(),
	  'id_presence'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'add_empty' => true)),
	   'montantsociale'       => new sfWidgetFormFilterInput(),
	     'salairebrutannuel'    => new sfWidgetFormFilterInput(),
		   'montantirpp'          => new sfWidgetFormFilterInput(),
		      'montantsocialemensuel' => new sfWidgetFormFilterInput(),
			   'noterendement'         => new sfWidgetFormFilterInput(),
      'notepresence'          => new sfWidgetFormFilterInput(),
      'sbrutderniermois'      => new sfWidgetFormFilterInput(),
      'basecalculprime'       => new sfWidgetFormFilterInput(),
      'brutprime'             => new sfWidgetFormFilterInput(),
	   'id_lignecodesociale'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'add_empty' => true)),
    
    
    ));

    $this->setValidators(array(
      'id_agents'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_codesociale'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id')),
      'id_contribution'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id')),
      'id_bareme'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Baremeimpot'), 'column' => 'id')),
      'id_historiqueretenue' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Historiqueretenue'), 'column' => 'id')),
      'mois'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'annee'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'assurance'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'irpp'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cnss'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'salairebrut'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'netsociale'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattement'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattementfraaisprof' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattementenfant'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abatementcheffamille' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'salaireimposable'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'imposablemensuel'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'retenueimposable'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'salairenet'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalacompte'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalretenue'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'netapayyer'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  'id_dossier'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
	  'id_annepaie'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
	    'salairedebase'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'contribitionsociale'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   'id_contrat'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
	   'nbrjtravaille'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrjconge'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
	   'nbrjf'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbabscenceir'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
	   'id_presence'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Presence'), 'column' => 'id')),
        'montantsociale'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
		     'salairebrutannuel'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
			  'montantirpp'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
       'montantsocialemensuel' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	    'noterendement'         => new sfValidatorPass(array('required' => false)),
      'notepresence'          => new sfValidatorPass(array('required' => false)),
      'sbrutderniermois'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'basecalculprime'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'brutprime'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   'id_lignecodesociale'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignecodesociale'), 'column' => 'id')),
	));

    $this->widgetSchema->setNameFormat('paie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paie';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_agents'            => 'ForeignKey',
      'id_codesociale'       => 'ForeignKey',
      'id_contribution'      => 'ForeignKey',
      'id_bareme'            => 'ForeignKey',
      'id_historiqueretenue' => 'ForeignKey',
      'mois'                 => 'Number',
      'annee'                => 'Number',
      'assurance'            => 'Number',
      'irpp'                 => 'Boolean',
      'cnss'                 => 'Boolean',
      'salairebrut'          => 'Number',
      'netsociale'           => 'Number',
      'abattement'           => 'Number',
      'abattementfraaisprof' => 'Number',
      'abattementenfant'     => 'Number',
      'abatementcheffamille' => 'Number',
      'salaireimposable'     => 'Number',
      'imposablemensuel'     => 'Number',
      'retenueimposable'     => 'Number',
      'salairenet'           => 'Number',
      'totalacompte'         => 'Number',
      'totalretenue'         => 'Number',
      'netapayyer'           => 'Number',
	   'id_lignecodesociale'   => 'ForeignKey',
    );
  }
}
