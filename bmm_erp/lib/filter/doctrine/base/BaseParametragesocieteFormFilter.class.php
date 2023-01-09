<?php

/**
 * Parametragesociete filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametragesocieteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valeurfodec' => new sfWidgetFormFilterInput(),
      'id_societe'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'timbre'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'valeurfodec' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_societe'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Societe'), 'column' => 'id')),
      'timbre'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('parametragesociete_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametragesociete';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'valeurfodec' => 'Number',
      'id_societe'  => 'ForeignKey',
      'timbre'      => 'Number',
    );
  }
}
