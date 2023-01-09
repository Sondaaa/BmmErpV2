<?php

/**
 * Documentparent filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentparentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_documentachat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_documentparent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_2'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_documentachat'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'id_documentparent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat_2'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('documentparent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentparent';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_documentachat'  => 'ForeignKey',
      'id_documentparent' => 'ForeignKey',
    );
  }
}
