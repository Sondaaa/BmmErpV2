<?php

/**
 * Grade filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGradeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'      => new sfWidgetFormFilterInput(),
      'id_corpsdet'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corpsdet'), 'add_empty' => true)),
      'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'      => new sfValidatorPass(array('required' => false)),
      'id_corpsdet'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Corpsdet'), 'column' => 'id')),
      'id_categorie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorierh'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grade';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'libelle'      => 'Text',
      'id_corpsdet'  => 'ForeignKey',
      'id_categorie' => 'ForeignKey',
    );
  }
}
