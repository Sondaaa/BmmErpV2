<?php

/**
 * Tracedocachat form base class.
 *
 * @method Tracedocachat getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTracedocachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_docparent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_2'), 'add_empty' => true)),
      'id_docfils'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_docparent' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_2'), 'required' => false)),
      'id_docfils'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tracedocachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tracedocachat';
  }

}
