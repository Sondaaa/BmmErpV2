<?php

/**
 * Maquette filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMaquetteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'           => new sfWidgetFormFilterInput(),
      'libelle'        => new sfWidgetFormFilterInput(),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_journal'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'id_naturepiece' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepiece'), 'add_empty' => true)),
      'id_user'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'code'           => new sfValidatorPass(array('required' => false)),
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_journal'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id')),
      'id_naturepiece' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturepiece'), 'column' => 'id')),
      'id_user'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('maquette_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Maquette';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'code'           => 'Text',
      'libelle'        => 'Text',
      'date'           => 'Date',
      'id_journal'     => 'ForeignKey',
      'id_naturepiece' => 'ForeignKey',
      'id_user'        => 'ForeignKey',
    );
  }
}
