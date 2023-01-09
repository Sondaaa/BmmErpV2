<?php

/**
 * Typetenue filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypetenueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'       => new sfWidgetFormFilterInput(),
      'id_typemisson' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'       => new sfValidatorPass(array('required' => false)),
      'id_typemisson' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typemission'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('typetenue_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typetenue';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'libelle'       => 'Text',
      'id_typemisson' => 'ForeignKey',
    );
  }
}
