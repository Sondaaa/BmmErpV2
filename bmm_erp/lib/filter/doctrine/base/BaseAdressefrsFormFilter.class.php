<?php

/**
 * Adressefrs filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdressefrsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'adrs'       => new sfWidgetFormFilterInput(),
      'codepostal' => new sfWidgetFormFilterInput(),
      'id_pays'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_gouv'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'lat'        => new sfWidgetFormFilterInput(),
      'lngitude'   => new sfWidgetFormFilterInput(),
      'id_frs'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'adrs'       => new sfValidatorPass(array('required' => false)),
      'codepostal' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_pays'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
      'id_gouv'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
      'lat'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lngitude'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_frs'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('adressefrs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressefrs';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'adrs'       => 'Text',
      'codepostal' => 'Number',
      'id_pays'    => 'ForeignKey',
      'id_gouv'    => 'ForeignKey',
      'lat'        => 'Number',
      'lngitude'   => 'Number',
      'id_frs'     => 'ForeignKey',
    );
  }
}
