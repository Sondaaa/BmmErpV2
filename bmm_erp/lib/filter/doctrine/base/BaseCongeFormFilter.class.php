<?php

/**
 * Conge filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCongeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'              => new sfWidgetFormFilterInput(),
      'datedebut'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nbrjour'              => new sfWidgetFormFilterInput(),
      'lieu'                 => new sfWidgetFormFilterInput(),
      'datedemande'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieudedemane'         => new sfWidgetFormFilterInput(),
      'signature'            => new sfWidgetFormFilterInput(),
      'datedebutvalide'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinvalide'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_agents'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'datevalide'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'signatureresponsable' => new sfWidgetFormFilterInput(),
      'congeaquise'          => new sfWidgetFormFilterInput(),
      'nbjcongeannuelle'     => new sfWidgetFormFilterInput(),
      'id_type'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'add_empty' => true)),
      'valide'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'objection'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nbrjvalide'           => new sfWidgetFormFilterInput(),
      'responsable'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'add_empty' => true)),
      'nbrrestantannepr'     => new sfWidgetFormFilterInput(),
      'nbrcongeralise'       => new sfWidgetFormFilterInput(),
      'nbrcongerestant'      => new sfWidgetFormFilterInput(),
      'daterealise'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinrealise'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedenutprologement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinprolongement'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
	   'annee'                => new sfWidgetFormFilterInput(),
	  'extension'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nbrjourrealise'       => new sfWidgetFormFilterInput(),
	   'nbrjourprolonge'      => new sfWidgetFormFilterInput(),
 
    ));

    $this->setValidators(array(
      'libelle'              => new sfValidatorPass(array('required' => false)),
      'datedebut'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nbrjour'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lieu'                 => new sfValidatorPass(array('required' => false)),
      'datedemande'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieudedemane'         => new sfValidatorPass(array('required' => false)),
      'signature'            => new sfValidatorPass(array('required' => false)),
      'datedebutvalide'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinvalide'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_agents'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'datevalide'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'signatureresponsable' => new sfValidatorPass(array('required' => false)),
      'congeaquise'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbjcongeannuelle'     => new sfValidatorPass(array('required' => false)),
      'id_type'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeconge'), 'column' => 'id')),
      'valide'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'objection'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nbrjvalide'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'responsable'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents_3'), 'column' => 'id')),
      'nbrrestantannepr'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrcongeralise'       => new sfValidatorPass(array('required' => false)),
      'nbrcongerestant'      => new sfValidatorPass(array('required' => false)),
      'daterealise'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinrealise'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedenutprologement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinprolongement'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
     'annee'                => new sfValidatorPass(array('required' => false)),  
      'extension'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nbrjourrealise'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrjourprolonge'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
  ));

    $this->widgetSchema->setNameFormat('conge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conge';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'libelle'              => 'Text',
      'datedebut'            => 'Date',
      'datefin'              => 'Date',
      'nbrjour'              => 'Number',
      'lieu'                 => 'Text',
      'datedemande'          => 'Date',
      'lieudedemane'         => 'Text',
      'signature'            => 'Text',
      'datedebutvalide'      => 'Date',
      'datefinvalide'        => 'Date',
      'id_agents'            => 'ForeignKey',
      'datevalide'           => 'Date',
      'signatureresponsable' => 'Text',
      'congeaquise'          => 'Number',
      'nbjcongeannuelle'     => 'Text',
      'id_type'              => 'ForeignKey',
      'valide'               => 'Boolean',
      'objection'            => 'Boolean',
      'nbrjvalide'           => 'Number',
      'responsable'          => 'ForeignKey',
      'nbrrestantannepr'     => 'Number',
      'nbrcongeralise'       => 'Text',
      'nbrcongerestant'      => 'Text',
      'daterealise'          => 'Date',
      'datefinrealise'       => 'Date',
      'datedenutprologement' => 'Date',
      'datefinprolongement'  => 'Date',
	   'extension'              => 'Boolean',
      'nbrjourrealise'       => 'Number',
	   'nbrjourprolonge'      => 'Number',
    );
  }
}
