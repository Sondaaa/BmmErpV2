<?php

/**
 * Noteexplicatif form base class.
 *
 * @method Noteexplicatif getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseNoteexplicatifForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'fichejoint'  => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'id_doc'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fichejoint'  => new sfValidatorString(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'id_doc'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('noteexplicatif[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noteexplicatif';
  }

}
