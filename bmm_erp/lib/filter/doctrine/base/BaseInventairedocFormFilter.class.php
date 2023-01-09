<?php

/**
 * Inventairedoc filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInventairedocFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_doc'     => new sfWidgetFormFilterInput(),
      'id_empl'    => new sfWidgetFormFilterInput(),
      'qteexstant' => new sfWidgetFormFilterInput(),
      'qtereel'    => new sfWidgetFormFilterInput(),
      'ecart'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_doc'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_empl'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'qteexstant' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'qtereel'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ecart'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('inventairedoc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventairedoc';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_doc'     => 'Number',
      'id_empl'    => 'Number',
      'qteexstant' => 'Number',
      'qtereel'    => 'Number',
      'ecart'      => 'Number',
    );
  }
}
