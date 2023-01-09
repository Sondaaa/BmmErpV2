<?php

/**
 * Journalcentralisateur filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJournalcentralisateurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_exercice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'id_journal'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'mois'        => new sfWidgetFormFilterInput(),
      'debit'       => new sfWidgetFormFilterInput(),
      'credit'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_exercice' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
      'id_journal'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journalcomptable'), 'column' => 'id')),
      'mois'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'debit'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('journalcentralisateur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journalcentralisateur';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_exercice' => 'ForeignKey',
      'id_journal'  => 'ForeignKey',
      'mois'        => 'Number',
      'debit'       => 'Number',
      'credit'      => 'Number',
    );
  }
}
