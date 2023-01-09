<?php

/**
 * Typeoperation form base class.
 *
 * @method Typeoperation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTypeoperationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'   => new sfWidgetFormInputText(),
      'id'        => new sfWidgetFormInputHidden(),
      'valeurop'  => new sfWidgetFormInputText(),
      'id_banque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'codeop'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'libelle'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'valeurop'  => new sfValidatorNumber(array('required' => false)),
      'id_banque' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id', 'required' => false)),
      'codeop'    => new sfValidatorString(array('max_length' => 4, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeoperation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeoperation';
  }

}
