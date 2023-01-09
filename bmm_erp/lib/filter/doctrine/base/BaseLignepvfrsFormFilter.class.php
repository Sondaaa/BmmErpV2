<?php

/**
 * Lignepvfrs filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignepvfrsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pv'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
      'id_frs' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_pv'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pvdoc'), 'column' => 'id')),
      'id_frs' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignepvfrs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepvfrs';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'id_pv'  => 'ForeignKey',
      'id_frs' => 'Number',
    );
  }
}
