<?php

/**
 * Bordereauvirement form base class.
 *
 * @method Bordereauvirement getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseBordereauvirementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'date'                 => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_compte'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'id_typeoperation'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
      'id_naturecompte'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'total'                => new sfWidgetFormInputText(),
      'id_papierordrepostal' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Papierordrepostal'), 'add_empty' => true)),
      'valide'               => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                 => new sfValidatorDate(array('required' => false)),
      'id_compte'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id', 'required' => false)),
      'id_typeoperation'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'column' => 'id', 'required' => false)),
      'id_naturecompte'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id', 'required' => false)),
      'total'                => new sfValidatorNumber(array('required' => false)),
      'id_papierordrepostal' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Papierordrepostal'), 'column' => 'id', 'required' => false)),
      'valide'               => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bordereauvirement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bordereauvirement';
  }

}
