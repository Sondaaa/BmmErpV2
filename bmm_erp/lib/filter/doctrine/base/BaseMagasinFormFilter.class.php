<?php

/**
 * Magasin filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMagasinFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'        => new sfWidgetFormFilterInput(),
      'id_pay'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_gouvernera'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_emplacement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'add_empty' => true)),
      'id_site'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'id_mag'         => new sfWidgetFormFilterInput(),
      'code'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'id_pay'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
      'id_gouvernera'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
      'id_emplacement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Emplacement'), 'column' => 'id')),
      'id_site'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'id_mag'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('magasin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Magasin';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'libelle'        => 'Text',
      'id_pay'         => 'ForeignKey',
      'id_gouvernera'  => 'ForeignKey',
      'id_emplacement' => 'ForeignKey',
      'id_site'        => 'ForeignKey',
      'id_mag'         => 'Number',
      'code'           => 'Text',
    );
  }
}
