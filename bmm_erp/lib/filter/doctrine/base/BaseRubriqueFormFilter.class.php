<?php

/**
 * Rubrique filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRubriqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'     => new sfWidgetFormFilterInput(),
      'id_rubrique' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'     => new sfValidatorPass(array('required' => false)),
      'id_rubrique' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rubrique_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rubrique';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'libelle'     => 'Text',
      'id_rubrique' => 'Number',
    );
  }
}
