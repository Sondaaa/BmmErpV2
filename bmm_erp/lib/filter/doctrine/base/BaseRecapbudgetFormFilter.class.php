<?php

/**
 * Recapbudget filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecapbudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_rubrique'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'id_budget'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'lib_rubrique'    => new sfWidgetFormFilterInput(),
      'annees_exercice' => new sfWidgetFormFilterInput(),
      'date_creation'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_ligrubtitre'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mois'            => new sfWidgetFormFilterInput(),
      'mnt_allouer'     => new sfWidgetFormFilterInput(),
      'mnt_encager'     => new sfWidgetFormFilterInput(),
      'mnt_maiement'    => new sfWidgetFormFilterInput(),
      'relicat_engager' => new sfWidgetFormFilterInput(),
      'relicat_paiment' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_rubrique'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id')),
      'id_budget'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'lib_rubrique'    => new sfValidatorPass(array('required' => false)),
      'annees_exercice' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_creation'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_ligrubtitre'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'mois'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mnt_allouer'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnt_encager'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnt_maiement'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'relicat_engager' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'relicat_paiment' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('recapbudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recapbudget';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_rubrique'     => 'ForeignKey',
      'id_budget'       => 'ForeignKey',
      'lib_rubrique'    => 'Text',
      'annees_exercice' => 'Number',
      'date_creation'   => 'Date',
      'id_ligrubtitre'  => 'ForeignKey',
      'mois'            => 'Number',
      'mnt_allouer'     => 'Number',
      'mnt_encager'     => 'Number',
      'mnt_maiement'    => 'Number',
      'relicat_engager' => 'Number',
      'relicat_paiment' => 'Number',
    );
  }
}
