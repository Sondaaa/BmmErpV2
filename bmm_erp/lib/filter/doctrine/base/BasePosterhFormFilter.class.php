<?php

/**
 * Posterh filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePosterhFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'  => new sfWidgetFormFilterInput(),
      'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'  => new sfValidatorPass(array('required' => false)),
      'id_unite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unite'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('posterh_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Posterh';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'libelle'  => 'Text',
      'id_unite' => 'ForeignKey',
    );
  }
}
