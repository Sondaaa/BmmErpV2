<?php

/**
 * Ouvrier filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOuvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'matricule'        => new sfWidgetFormFilterInput(),
      'nom'              => new sfWidgetFormFilterInput(),
      'prenom'           => new sfWidgetFormFilterInput(),
      'cin'              => new sfWidgetFormFilterInput(),
      'idcnrps'          => new sfWidgetFormFilterInput(),
      'dateafficliation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'adresse'          => new sfWidgetFormFilterInput(),
      'datenaissance'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'rib'              => new sfWidgetFormFilterInput(),
      'id_gouv'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_pays'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_situation'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'add_empty' => true)),
      'id_sexe'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'add_empty' => true)),
      'nbrenfant'        => new sfWidgetFormFilterInput(),
	    'id_lieunaissance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera_5'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'matricule'        => new sfValidatorPass(array('required' => false)),
      'nom'              => new sfValidatorPass(array('required' => false)),
      'prenom'           => new sfValidatorPass(array('required' => false)),
      'cin'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idcnrps'          => new sfValidatorPass(array('required' => false)),
      'dateafficliation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adresse'          => new sfValidatorPass(array('required' => false)),
      'datenaissance'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'rib'              =>  new sfValidatorPass(array('required' => false)),
      'id_gouv'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
      'id_pays'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
      'id_situation'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etatcivil'), 'column' => 'id')),
      'id_sexe'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sexe'), 'column' => 'id')),
      'nbrenfant'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_lieunaissance' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera_5'), 'column' => 'id')),
	));

    $this->widgetSchema->setNameFormat('ouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ouvrier';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'matricule'        => 'Text',
      'nom'              => 'Text',
      'prenom'           => 'Text',
      'cin'              => 'Number',
      'idcnrps'          => 'Text',
      'dateafficliation' => 'Date',
      'adresse'          => 'Text',
      'datenaissance'    => 'Date',
      'rib'              => 'Text',
      'id_gouv'          => 'ForeignKey',
      'id_pays'          => 'ForeignKey',
      'id_situation'     => 'ForeignKey',
      'id_sexe'          => 'ForeignKey',
      'nbrenfant'        => 'Number',
    );
  }
}
