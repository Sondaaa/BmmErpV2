<?php

/**
 * Tableauxammortisement filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTableauxammortisementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_immobilisation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'date_aquisition'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'vorigine'          => new sfWidgetFormFilterInput(),
      'taux'              => new sfWidgetFormFilterInput(),
      'dotation'          => new sfWidgetFormFilterInput(),
      'amrtinterieur'     => new sfWidgetFormFilterInput(),
      'amrtcumile'        => new sfWidgetFormFilterInput(),
      'vcn'               => new sfWidgetFormFilterInput(),
      'datetableux'       => new sfWidgetFormFilterInput(array(),array('type'=>'date')),
    ));

    $this->setValidators(array(
      'id_immobilisation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Immobilisation'), 'column' => 'id')),
      'date_aquisition'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'vorigine'          => new sfValidatorPass(array('required' => false)),
      'taux'              => new sfValidatorPass(array('required' => false)),
      'dotation'          => new sfValidatorPass(array('required' => false)),
      'amrtinterieur'     => new sfValidatorPass(array('required' => false)),
      'amrtcumile'        => new sfValidatorPass(array('required' => false)),
      'vcn'               => new sfValidatorPass(array('required' => false)),
      'datetableux'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tableauxammortisement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tableauxammortisement';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_immobilisation' => 'ForeignKey',
      'date_aquisition'   => 'Date',
      'vorigine'          => 'Text',
      'taux'              => 'Text',
      'dotation'          => 'Text',
      'amrtinterieur'     => 'Text',
      'amrtcumile'        => 'Text',
      'vcn'               => 'Text',
      'datetableux'       => 'Date',
    );
  }
}
