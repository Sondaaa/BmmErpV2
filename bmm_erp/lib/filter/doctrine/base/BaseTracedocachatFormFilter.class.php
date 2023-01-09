<?php

/**
 * Tracedocachat filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTracedocachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_docparent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_2'), 'add_empty' => true)),
      'id_docfils'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_docparent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat_2'), 'column' => 'id')),
      'id_docfils'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tracedocachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tracedocachat';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_docparent' => 'ForeignKey',
      'id_docfils'   => 'ForeignKey',
    );
  }
}
