<?php

/**
 * Demandeavancepret filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeavancepretFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'datedemande'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montant'          => new sfWidgetFormFilterInput(),
      'id_type'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'add_empty' => true)),
      'valide'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dateva'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montantvavance'   => new sfWidgetFormFilterInput(),
      'mois'             => new sfWidgetFormFilterInput(),
      'montantmensuelle' => new sfWidgetFormFilterInput(),
      'nbrmois'          => new sfWidgetFormFilterInput(),
      'id_avance'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'add_empty' => true)),
      'id_pret'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'add_empty' => true)),
      'id_retenue'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenue'), 'add_empty' => true)),
      'type'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_agents'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'datedemande'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montant'          => new sfValidatorPass(array('required' => false)),
      'id_type'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeavancepret'), 'column' => 'id')),
      'valide'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dateva'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montantvavance'   => new sfValidatorPass(array('required' => false)),
      'mois'             => new sfValidatorPass(array('required' => false)),
      'montantmensuelle' => new sfValidatorPass(array('required' => false)),
      'nbrmois'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_avance'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avance'), 'column' => 'id')),
      'id_pret'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pret'), 'column' => 'id')),
      'id_retenue'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Retenue'), 'column' => 'id')),
      'type'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demandeavancepret_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandeavancepret';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_agents'        => 'ForeignKey',
      'datedemande'      => 'Date',
      'montant'          => 'Text',
      'id_type'          => 'ForeignKey',
      'valide'           => 'Boolean',
      'dateva'           => 'Date',
      'montantvavance'   => 'Text',
      'mois'             => 'Text',
      'montantmensuelle' => 'Text',
      'nbrmois'          => 'Number',
      'id_avance'        => 'ForeignKey',
      'id_pret'          => 'ForeignKey',
      'id_retenue'       => 'ForeignKey',
      'type'             => 'Text',
    );
  }
}
