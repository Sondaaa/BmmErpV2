<?php

/**
 * Lignepvvisa filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignepvvisaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_visa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_pv'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_visa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Visaachat'), 'column' => 'id')),
      'id_pv'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pvdoc'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignepvvisa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepvvisa';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'id_visa' => 'ForeignKey',
      'id_pv'   => 'ForeignKey',
    );
  }
}
