<?php

/**
 * Sousrubrique filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousrubriqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'        => new sfWidgetFormFilterInput(),
      'libelle'     => new sfWidgetFormFilterInput(),
      'id_rubrique' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubriqueformation'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'code'        => new sfValidatorPass(array('required' => false)),
      'libelle'     => new sfValidatorPass(array('required' => false)),
      'id_rubrique' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubriqueformation'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sousrubrique_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousrubrique';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'code'        => 'Number',
      'libelle'     => 'Text',
      'id_rubrique' => 'ForeignKey',
    );
  }
}
