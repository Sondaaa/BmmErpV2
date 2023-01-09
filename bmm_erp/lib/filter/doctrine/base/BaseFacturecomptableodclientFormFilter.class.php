<?php

/**
 * Facturecomptableodclient filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFacturecomptableodclientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reference'         => new sfWidgetFormFilterInput(),
      'totalht'           => new sfWidgetFormFilterInput(),
      'totaltva'          => new sfWidgetFormFilterInput(),
      'timbre'            => new sfWidgetFormFilterInput(),
      'totalttc'          => new sfWidgetFormFilterInput(),
      'id_dossier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'dateimportation'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'saisie'            => new sfWidgetFormFilterInput(),
      'id_facture'        => new sfWidgetFormFilterInput(),
      'id_client'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'id_devise'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_piececomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'            => new sfWidgetFormFilterInput(),
      'id_compteretenue'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'reference'         => new sfValidatorPass(array('required' => false)),
      'totalht'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totaltva'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'timbre'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalttc'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'dateimportation'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'saisie'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_facture'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_client'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'id_devise'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'id_piececomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id')),
      'numero'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_compteretenue'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('facturecomptableodclient_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facturecomptableodclient';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'date'              => 'Date',
      'reference'         => 'Text',
      'totalht'           => 'Number',
      'totaltva'          => 'Number',
      'timbre'            => 'Number',
      'totalttc'          => 'Number',
      'id_dossier'        => 'ForeignKey',
      'dateimportation'   => 'Date',
      'saisie'            => 'Number',
      'id_facture'        => 'Number',
      'id_client'         => 'ForeignKey',
      'id_devise'         => 'ForeignKey',
      'id_piececomptable' => 'ForeignKey',
      'numero'            => 'Number',
      'id_compteretenue'  => 'ForeignKey',
    );
  }
}
