<?php

/**
 * Numeroseriejournal filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNumeroseriejournalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'prefixe'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datedebut'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'datefin'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'numerodebut' => new sfWidgetFormFilterInput(),
      'numerofin'   => new sfWidgetFormFilterInput(),
      'attendu'     => new sfWidgetFormFilterInput(),
      'isbloque'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'isvalide'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_journal'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'prefixe'     => new sfValidatorPass(array('required' => false)),
      'datedebut'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'numerodebut' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numerofin'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'attendu'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isbloque'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isvalide'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_journal'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('numeroseriejournal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Numeroseriejournal';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'prefixe'     => 'Text',
      'datedebut'   => 'Date',
      'datefin'     => 'Date',
      'numerodebut' => 'Number',
      'numerofin'   => 'Number',
      'attendu'     => 'Number',
      'isbloque'    => 'Number',
      'isvalide'    => 'Number',
      'id_journal'  => 'ForeignKey',
    );
  }
}
