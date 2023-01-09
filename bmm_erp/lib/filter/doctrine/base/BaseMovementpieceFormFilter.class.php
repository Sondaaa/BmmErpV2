<?php

/**
 * Movementpiece filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMovementpieceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reference'          => new sfWidgetFormFilterInput(),
      'montant'            => new sfWidgetFormFilterInput(),
      'dateimportation'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'saisie'             => new sfWidgetFormFilterInput(),
      'id_piececomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'             => new sfWidgetFormFilterInput(),
      'datevaleur'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'libelle'            => new sfWidgetFormFilterInput(),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_dossier'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'type'               => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'reference'          => new sfValidatorPass(array('required' => false)),
      'montant'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dateimportation'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'saisie'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_piececomptable'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id')),
      'numero'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datevaleur'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libelle'            => new sfValidatorPass(array('required' => false)),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id')),
      'id_dossier'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'type'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movementpiece_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Movementpiece';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'date'               => 'Date',
      'reference'          => 'Text',
      'montant'            => 'Number',
      'dateimportation'    => 'Date',
      'saisie'             => 'Number',
      'id_piececomptable'  => 'ForeignKey',
      'numero'             => 'Number',
      'datevaleur'         => 'Date',
      'libelle'            => 'Text',
      'id_comptecomptable' => 'ForeignKey',
      'id_dossier'         => 'ForeignKey',
      'type'               => 'Text',
    );
  }
}
