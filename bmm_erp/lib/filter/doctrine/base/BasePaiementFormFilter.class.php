<?php

/**
 * Paiement filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaiementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_contribution'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'tfp'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'foprolos'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mois'                 => new sfWidgetFormFilterInput(),
      'annee'                => new sfWidgetFormFilterInput(),
      'salairenet'           => new sfWidgetFormFilterInput(),
      'netapayer'            => new sfWidgetFormFilterInput(),
      'id_dossier'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'netsociale'           => new sfWidgetFormFilterInput(),
      'salaireimposable'     => new sfWidgetFormFilterInput(),
      'abattementfraaisprof' => new sfWidgetFormFilterInput(),
      'abattement'           => new sfWidgetFormFilterInput(),
      'retenueimposable'     => new sfWidgetFormFilterInput(),
      'imposablemensuel'     => new sfWidgetFormFilterInput(),
      'abattementenfant'     => new sfWidgetFormFilterInput(),
      'salairebrut'          => new sfWidgetFormFilterInput(),
      'totalretenue'         => new sfWidgetFormFilterInput(),
	    'id_entetpaie'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Entetepaie'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_agents'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_contribution'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id')),
      'tfp'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'foprolos'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mois'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'annee'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'salairenet'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'netapayer'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_dossier'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'netsociale'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'salaireimposable'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattementfraaisprof' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattement'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'retenueimposable'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'imposablemensuel'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'abattementenfant'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'salairebrut'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalretenue'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	    'id_entetpaie'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Entetepaie'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('paiement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paiement';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_agents'            => 'ForeignKey',
      'id_contribution'      => 'ForeignKey',
      'tfp'                  => 'Boolean',
      'foprolos'             => 'Boolean',
      'mois'                 => 'Number',
      'annee'                => 'Number',
      'salairenet'           => 'Number',
      'netapayer'            => 'Number',
      'id_dossier'           => 'ForeignKey',
      'netsociale'           => 'Number',
      'salaireimposable'     => 'Number',
      'abattementfraaisprof' => 'Number',
      'abattement'           => 'Number',
      'retenueimposable'     => 'Number',
      'imposablemensuel'     => 'Number',
      'abattementenfant'     => 'Number',
      'salairebrut'          => 'Number',
      'totalretenue'         => 'Number',
    );
  }
}
