<?php

/**
 * Ligneniveuxeducatif filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneniveuxeducatifFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'       => new sfWidgetFormFilterInput(),
      'id_niveaueducatif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'add_empty' => true)),
      'id_agents'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'description'       => new sfValidatorPass(array('required' => false)),
      'id_niveaueducatif' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Niveaueducatif'), 'column' => 'id')),
      'id_agents'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ligneniveuxeducatif_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneniveuxeducatif';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'description'       => 'Text',
      'id_niveaueducatif' => 'ForeignKey',
      'id_agents'         => 'ForeignKey',
    );
  }
}
