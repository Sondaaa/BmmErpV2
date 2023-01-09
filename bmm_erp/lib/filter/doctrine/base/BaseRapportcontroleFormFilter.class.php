<?php

/**
 * Rapportcontrole filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRapportcontroleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datecreation'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_chantiercontrole' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantiercontrole'), 'add_empty' => true)),
      'id_projet'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_naturetravaux'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturetravaux'), 'add_empty' => true)),
      'total'               => new sfWidgetFormFilterInput(),
      'observation'         => new sfWidgetFormFilterInput(),
      'id_servicecontrole'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicecontrole'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'datecreation'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_chantiercontrole' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantiercontrole'), 'column' => 'id')),
      'id_projet'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
      'id_naturetravaux'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturetravaux'), 'column' => 'id')),
      'total'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation'         => new sfValidatorPass(array('required' => false)),
      'id_servicecontrole'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Servicecontrole'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rapportcontrole_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rapportcontrole';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'datecreation'        => 'Date',
      'id_chantiercontrole' => 'ForeignKey',
      'id_projet'           => 'ForeignKey',
      'id_naturetravaux'    => 'ForeignKey',
      'total'               => 'Number',
      'observation'         => 'Text',
      'id_servicecontrole'  => 'ForeignKey',
    );
  }
}
