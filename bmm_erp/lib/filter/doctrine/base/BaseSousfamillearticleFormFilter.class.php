<?php

/**
 * Sousfamillearticle filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousfamillearticleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'    => new sfWidgetFormFilterInput(),
      'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'add_empty' => true)),
      'code'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'    => new sfValidatorPass(array('required' => false)),
      'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famillearticle'), 'column' => 'id')),
      'code'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousfamillearticle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousfamillearticle';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'libelle'    => 'Text',
      'id_famille' => 'ForeignKey',
      'code'       => 'Text',
    );
  }
}
