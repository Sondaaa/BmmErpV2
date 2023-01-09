<?php

/**
 * Attestationdetravail filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAttestationdetravailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_lieu'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'cause'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_lieu'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
      'cause'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('attestationdetravail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attestationdetravail';
  }

  public function getFields()
  {
    return array(
      'id_agents' => 'ForeignKey',
      'id_lieu'   => 'ForeignKey',
      'id'        => 'Number',
      'cause'     => 'Text',
    );
  }
}
