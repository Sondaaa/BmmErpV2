<?php

/**
 * Piececomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePiececomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'libelle'             => new sfWidgetFormFilterInput(),
      'date'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'totaldebit'          => new sfWidgetFormFilterInput(),
      'totalcredit'         => new sfWidgetFormFilterInput(),
      'reserve'             => new sfWidgetFormFilterInput(),
      'editable'            => new sfWidgetFormFilterInput(),
      'id_journalcomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'id_serie'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Numeroseriejournal'), 'add_empty' => true)),
      'id_user'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_piecesource'      => new sfWidgetFormFilterInput(),
      'id_exercice'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'dateliberation'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'liberer'             => new sfWidgetFormFilterInput(),
      'anciennumero'        => new sfWidgetFormFilterInput(),
      'daterenumerotation'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_devise'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'              => new sfValidatorPass(array('required' => false)),
      'libelle'             => new sfValidatorPass(array('required' => false)),
      'date'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'totaldebit'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalcredit'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'reserve'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'editable'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_journalcomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id')),
      'id_serie'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Numeroseriejournal'), 'column' => 'id')),
      'id_user'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'datecreation'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_piecesource'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_exercice'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
      'dateliberation'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'liberer'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anciennumero'        => new sfValidatorPass(array('required' => false)),
      'daterenumerotation'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_devise'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('piececomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Piececomptable';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'numero'              => 'Text',
      'libelle'             => 'Text',
      'date'                => 'Date',
      'totaldebit'          => 'Number',
      'totalcredit'         => 'Number',
      'reserve'             => 'Number',
      'editable'            => 'Number',
      'id_journalcomptable' => 'ForeignKey',
      'id_serie'            => 'ForeignKey',
      'id_user'             => 'ForeignKey',
      'datecreation'        => 'Date',
      'id_piecesource'      => 'Number',
      'id_exercice'         => 'ForeignKey',
      'dateliberation'      => 'Date',
      'liberer'             => 'Number',
      'anciennumero'        => 'Text',
      'daterenumerotation'  => 'Date',
      'id_devise'           => 'ForeignKey',
    );
  }
}
