<?php

/**
 * Emplacement filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmplacementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_pays'       => new sfWidgetFormFilterInput(),
      'id_gouvernera' => new sfWidgetFormFilterInput(),
      'id_site'       => new sfWidgetFormFilterInput(),
      'id_etage'      => new sfWidgetFormFilterInput(),
      'id_bureau'     => new sfWidgetFormFilterInput(),
      'id_user'       => new sfWidgetFormFilterInput(),
      'adresse'       => new sfWidgetFormFilterInput(),
      'id_immo'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_pays'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_gouvernera' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_site'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_etage'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_bureau'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_user'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'adresse'       => new sfValidatorPass(array('required' => false)),
      'id_immo'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('emplacement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Emplacement';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_pays'       => 'Number',
      'id_gouvernera' => 'Number',
      'id_site'       => 'Number',
      'id_etage'      => 'Number',
      'id_bureau'     => 'Number',
      'id_user'       => 'Number',
      'adresse'       => 'Text',
      'id_immo'       => 'Number',
    );
  }
}
