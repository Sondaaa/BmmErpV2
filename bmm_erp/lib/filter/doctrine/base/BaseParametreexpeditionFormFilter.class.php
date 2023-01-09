<?php

/**
 * Parametreexpedition filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametreexpeditionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_exp'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'add_empty' => true)),
      'id_dest'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_2'), 'add_empty' => true)),
      'id_typecourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_exp'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Expdest'), 'column' => 'id')),
      'id_dest'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Expdest_2'), 'column' => 'id')),
      'id_typecourrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecourrier'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parametreexpedition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametreexpedition';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_exp'          => 'ForeignKey',
      'id_dest'         => 'ForeignKey',
      'id_typecourrier' => 'ForeignKey',
    );
  }
}
