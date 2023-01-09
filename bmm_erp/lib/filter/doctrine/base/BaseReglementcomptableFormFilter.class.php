<?php

/**
 * Reglementcomptable filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReglementcomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'refrence'           => new sfWidgetFormFilterInput(),
      'totalht'            => new sfWidgetFormFilterInput(),
      'totaltva'           => new sfWidgetFormFilterInput(),
      'timbre'             => new sfWidgetFormFilterInput(),
      'totalttc'           => new sfWidgetFormFilterInput(),
      'id_dossier'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'dateimportation'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'saisie'             => new sfWidgetFormFilterInput(),
      'id_piececomptable'  => new sfWidgetFormFilterInput(),
      'numero'             => new sfWidgetFormFilterInput(),
      'datevaleur'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'libelle'            => new sfWidgetFormFilterInput(),
      'type'               => new sfWidgetFormFilterInput(),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_banque'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'id_journal'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'id_frs'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_mouvement'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'refrence'           => new sfValidatorPass(array('required' => false)),
      'totalht'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totaltva'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'timbre'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalttc'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_dossier'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'dateimportation'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'saisie'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_piececomptable'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numero'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datevaleur'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libelle'            => new sfValidatorPass(array('required' => false)),
      'type'               => new sfValidatorPass(array('required' => false)),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id')),
      'id_banque'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
      'id_journal'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id')),
      'id_frs'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'id_mouvement'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mouvementbanciare'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('reglementcomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reglementcomptable';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'date'               => 'Date',
      'refrence'           => 'Text',
      'totalht'            => 'Number',
      'totaltva'           => 'Number',
      'timbre'             => 'Number',
      'totalttc'           => 'Number',
      'id_dossier'         => 'ForeignKey',
      'dateimportation'    => 'Date',
      'saisie'             => 'Number',
      'id_piececomptable'  => 'Number',
      'numero'             => 'Number',
      'datevaleur'         => 'Date',
      'libelle'            => 'Text',
      'type'               => 'Text',
      'id_comptecomptable' => 'ForeignKey',
      'id_banque'          => 'ForeignKey',
      'id_journal'         => 'ForeignKey',
      'id_frs'             => 'ForeignKey',
      'id_mouvement'       => 'ForeignKey',
    );
  }
}
