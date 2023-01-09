<?php

/**
 * MarchePrevesionelle filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseMarchePrevesionelleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(),
      'nbre_jour'         => new sfWidgetFormFilterInput(),
      'id_methode'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MethodeConclusion'), 'add_empty' => true)),
      'id_exercice'        => new sfWidgetFormDoctrineChoice(array('model' => 'Exercice','table_method' => 'getExerciceBudget', 'add_empty' => true)),
      'id_procedure'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProcedureMarche'), 'add_empty' => true)),
      'id_sources'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SourceMarcheprevesionelle'), 'add_empty' => true)),
      'created_cahier'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_annonce'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_overture'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_nomination'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_transmission' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_reponse'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_edition'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_notifier'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_commencement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'nbre_jour'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_methode'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MethodeConclusion'), 'column' => 'id')),
      'id_exercice'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
      'id_procedure'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProcedureMarche'), 'column' => 'id')),
      'id_sources'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SourceMarcheprevesionelle'), 'column' => 'id')),
      'created_cahier'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_annonce'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_overture'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_nomination'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_transmission' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_reponse'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_edition'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_notifier'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_commencement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('marche_prevesionelle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MarchePrevesionelle';
  }

  public function getFields()
  {
    return array(
      'name'              => 'Text',
      'id'                => 'Number',
      'nbre_jour'         => 'Number',
      'id_methode'        => 'ForeignKey',
      'id_procedure'      => 'ForeignKey',
      'id_sources'        => 'ForeignKey',
      'created_cahier'    => 'Date',
      'date_annonce'      => 'Date',
      'date_overture'     => 'Date',
      'date_nomination'   => 'Date',
      'date_transmission' => 'Date',
      'date_reponse'      => 'Date',
      'date_edition'      => 'Date',
      'date_notifier'     => 'Date',
      'date_commencement' => 'Date',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
