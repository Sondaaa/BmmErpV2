<?php

/**
 * Noteexplicatif filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNoteexplicatifFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fichejoint'  => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'id_doc'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fichejoint'  => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'id_doc'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('noteexplicatif_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noteexplicatif';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fichejoint'  => 'Text',
      'description' => 'Text',
      'id_doc'      => 'ForeignKey',
    );
  }
}
