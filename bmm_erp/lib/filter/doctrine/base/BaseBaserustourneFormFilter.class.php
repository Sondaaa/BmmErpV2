<?php

/**
 * Baserustourne filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBaserustourneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'         => new sfWidgetFormFilterInput(),
      'id_sousrubrique' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'id_sousrubrique' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousrubrique'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('baserustourne_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Baserustourne';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'libelle'         => 'Text',
      'id_sousrubrique' => 'ForeignKey',
    );
  }
}
