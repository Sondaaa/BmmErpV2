<?php

/**
 * Certificat filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCertificatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_naturecertif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecertif'), 'add_empty' => true)),
      'libellle'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_naturecertif' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturecertif'), 'column' => 'id')),
      'libellle'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('certificat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Certificat';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_naturecertif' => 'ForeignKey',
      'libellle'        => 'Text',
    );
  }
}
