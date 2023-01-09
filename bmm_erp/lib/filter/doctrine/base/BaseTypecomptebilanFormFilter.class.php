<?php

/**
 * Typecomptebilan filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypecomptebilanFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_typecompte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecompte'), 'add_empty' => true)),
      'id_compte'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_typecompte' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecompte'), 'column' => 'id')),
      'id_compte'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('typecomptebilan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typecomptebilan';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_typecompte' => 'ForeignKey',
      'id_compte'     => 'ForeignKey',
    );
  }
}
