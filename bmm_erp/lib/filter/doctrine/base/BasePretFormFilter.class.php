<?php

/**
 * Pret filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePretFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'   => new sfWidgetFormFilterInput(),
      'id_source' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'   => new sfValidatorPass(array('required' => false)),
      'id_source' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sourcepret'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('pret_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pret';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'libelle'   => 'Text',
      'id_source' => 'ForeignKey',
    );
  }
}
