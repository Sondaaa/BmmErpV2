<?php

/**
 * Sousprojet filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousprojetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'   => new sfWidgetFormFilterInput(),
      'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'   => new sfValidatorPass(array('required' => false)),
      'id_projet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sousprojet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousprojet';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'libelle'   => 'Text',
      'id_projet' => 'ForeignKey',
    );
  }
}
