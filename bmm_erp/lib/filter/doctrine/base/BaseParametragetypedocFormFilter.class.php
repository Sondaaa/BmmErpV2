<?php

/**
 * Parametragetypedoc filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametragetypedocFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_avis'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
      'id_visa'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_typedoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_avis'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avis'), 'column' => 'id')),
      'id_visa'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Visaachat'), 'column' => 'id')),
      'id_typedoc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typedoc'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parametragetypedoc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametragetypedoc';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_avis'    => 'ForeignKey',
      'id_visa'    => 'ForeignKey',
      'id_typedoc' => 'ForeignKey',
    );
  }
}
