<?php

/**
 * Journalcomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJournalcomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'libelle'               => new sfWidgetFormFilterInput(),
      'numerotation'          => new sfWidgetFormFilterInput(),
      'issimule'              => new sfWidgetFormFilterInput(),
      'isintegrer'            => new sfWidgetFormFilterInput(),
      'date'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'iscloture'             => new sfWidgetFormFilterInput(),
      'datedebutcloture'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefincloture'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'isbloque'              => new sfWidgetFormFilterInput(),
      'isvalide'              => new sfWidgetFormFilterInput(),
      'datedebutbloque'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'detefinbloque'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_type_journal'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typejournal'), 'add_empty' => true)),
      'id_comptecontrepartie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_dossier'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'id_exercice'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'code'                  => new sfValidatorPass(array('required' => false)),
      'libelle'               => new sfValidatorPass(array('required' => false)),
      'numerotation'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'issimule'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isintegrer'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'iscloture'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebutcloture'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefincloture'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'isbloque'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isvalide'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebutbloque'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'detefinbloque'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_type_journal'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typejournal'), 'column' => 'id')),
      'id_comptecontrepartie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'id_dossier'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'id_exercice'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('journalcomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journalcomptable';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'code'                  => 'Text',
      'libelle'               => 'Text',
      'numerotation'          => 'Number',
      'issimule'              => 'Number',
      'isintegrer'            => 'Number',
      'date'                  => 'Date',
      'iscloture'             => 'Number',
      'datedebutcloture'      => 'Date',
      'datefincloture'        => 'Date',
      'isbloque'              => 'Number',
      'isvalide'              => 'Number',
      'datedebutbloque'       => 'Date',
      'detefinbloque'         => 'Date',
      'id_type_journal'       => 'ForeignKey',
      'id_comptecontrepartie' => 'ForeignKey',
      'id_dossier'            => 'ForeignKey',
      'id_exercice'           => 'ForeignKey',
    );
  }
}
