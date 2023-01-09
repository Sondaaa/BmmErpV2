<?php

/**
 * Ligneattestationouvrier filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneattestationouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ouvrier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'id_attestation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Attestationouvrier'), 'add_empty' => true)),
      'nordre'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_ouvrier'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id')),
      'id_attestation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Attestationouvrier'), 'column' => 'id')),
      'nordre'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ligneattestationouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneattestationouvrier';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_ouvrier'     => 'ForeignKey',
      'id_attestation' => 'ForeignKey',
      'nordre'         => 'Number',
    );
  }
}
