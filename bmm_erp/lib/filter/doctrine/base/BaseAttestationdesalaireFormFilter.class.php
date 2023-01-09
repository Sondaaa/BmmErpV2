<?php

/**
 * Attestationdesalaire filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttestationdesalaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_lieu'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_agents'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_contrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'id_lieu'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('attestationdesalaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attestationdesalaire';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_agents'  => 'ForeignKey',
      'id_contrat' => 'ForeignKey',
      'id_lieu'    => 'ForeignKey',
    );
  }
}
