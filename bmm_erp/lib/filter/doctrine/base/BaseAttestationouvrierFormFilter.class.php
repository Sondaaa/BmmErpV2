<?php

/**
 * Attestationouvrier filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttestationouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_chantier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
      'id_direction'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'id_service'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
      'id_unite'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
      'budget'            => new sfWidgetFormFilterInput(),
      'porte'             => new sfWidgetFormFilterInput(),
      'datedebut'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_ouvrier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_chantier'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantier'), 'column' => 'id')),
      'id_direction'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
      'id_service'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Servicerh'), 'column' => 'id')),
      'id_unite'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unite'), 'column' => 'id')),
      'budget'            => new sfValidatorPass(array('required' => false)),
      'porte'             => new sfValidatorPass(array('required' => false)),
      'datedebut'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_ouvrier'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id')),
      'id_contratouvrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('attestationouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attestationouvrier';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_chantier'       => 'ForeignKey',
      'id_direction'      => 'ForeignKey',
      'id_service'        => 'ForeignKey',
      'id_unite'          => 'ForeignKey',
      'budget'            => 'Text',
      'porte'             => 'Text',
      'datedebut'         => 'Date',
      'datefin'           => 'Date',
      'id_ouvrier'        => 'ForeignKey',
      'id_contratouvrier' => 'ForeignKey',
    );
  }
}
