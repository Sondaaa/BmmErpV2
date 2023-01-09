<?php

/**
 * Qtelignedoc filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseQtelignedocFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'qtees'            => new sfWidgetFormFilterInput(),
      'qteep'            => new sfWidgetFormFilterInput(),
      'qteas'            => new sfWidgetFormFilterInput(),
      'qteap'            => new sfWidgetFormFilterInput(),
      'qteaachat'        => new sfWidgetFormFilterInput(),
      'qteeachat'        => new sfWidgetFormFilterInput(),
      'qtelivrefrs'      => new sfWidgetFormFilterInput(),
      'id_lignedocachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'add_empty' => true)),
      'qtedemander'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'qtees'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qteep'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qteas'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qteap'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qteaachat'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qteeachat'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qtelivrefrs'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_lignedocachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignedocachat'), 'column' => 'id')),
      'qtedemander'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('qtelignedoc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Qtelignedoc';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'qtees'            => 'Number',
      'qteep'            => 'Number',
      'qteas'            => 'Number',
      'qteap'            => 'Number',
      'qteaachat'        => 'Number',
      'qteeachat'        => 'Number',
      'qtelivrefrs'      => 'Number',
      'id_lignedocachat' => 'ForeignKey',
      'qtedemander'      => 'Number',
    );
  }
}
