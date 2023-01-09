<?php

/**
 * Alimentationcompte filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAlimentationcompteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_compte'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'montant'          => new sfWidgetFormFilterInput(),
      'id_tranchebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tranchebudget'), 'add_empty' => true)),
      'chemin'           => new sfWidgetFormFilterInput(),
      'type'             => new sfWidgetFormFilterInput(),
      'id_sourcesbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'add_empty' => true)),
      'libellesource'    => new sfWidgetFormFilterInput(),
      'id_titrebudget'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_compte'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
      'montant'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_tranchebudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tranchebudget'), 'column' => 'id')),
      'chemin'           => new sfValidatorPass(array('required' => false)),
      'type'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_sourcesbudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sourcesbudget'), 'column' => 'id')),
      'libellesource'    => new sfValidatorPass(array('required' => false)),
      'id_titrebudget'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alimentationcompte_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alimentationcompte';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'date'             => 'Date',
      'id_compte'        => 'ForeignKey',
      'montant'          => 'Number',
      'id_tranchebudget' => 'ForeignKey',
      'chemin'           => 'Text',
      'type'             => 'Number',
      'id_sourcesbudget' => 'ForeignKey',
      'libellesource'    => 'Text',
      'id_titrebudget'   => 'ForeignKey',
    );
  }
}
