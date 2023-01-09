<?php

/**
 * Droittimbre filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDroittimbreFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle' => new sfWidgetFormFilterInput(),
      'valeur'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle' => new sfValidatorPass(array('required' => false)),
      'valeur'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('droittimbre_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Droittimbre';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'libelle' => 'Text',
      'valeur'  => 'Number',
    );
  }
}
