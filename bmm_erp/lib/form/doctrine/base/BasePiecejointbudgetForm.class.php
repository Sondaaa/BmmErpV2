<?php

/**
 * Piecejointbudget form base class.
 *
 * @method Piecejointbudget getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePiecejointbudgetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'reference'         => new sfWidgetFormInputText(),
      'id_docachat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_type'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiecejointbudget'), 'add_empty' => true)),
      'id_documentbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
      'description'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference'         => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_docachat'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'id_type'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiecejointbudget'), 'column' => 'id', 'required' => false)),
      'id_documentbudget' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id', 'required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('piecejointbudget[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Piecejointbudget';
  }

}
