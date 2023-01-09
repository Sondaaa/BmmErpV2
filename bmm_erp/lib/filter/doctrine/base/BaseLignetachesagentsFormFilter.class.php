<?php

/**
 * Lignetachesagents filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignetachesagentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_tache'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taches'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_tache'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Taches'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignetachesagents_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetachesagents';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_agents' => 'ForeignKey',
      'id_tache'  => 'ForeignKey',
    );
  }
}
