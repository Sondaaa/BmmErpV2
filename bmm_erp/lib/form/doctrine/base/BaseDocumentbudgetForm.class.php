<?php

/**
 * Documentbudget form base class.
 *
 * @method Documentbudget getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDocumentbudgetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'numero'            => new sfWidgetFormInputText(),
         
      'datecreation'      => new sfWidgetFormInputText(array(), array('type' => 'date', 'value' => date('Y-m-d'))),
      'id_type'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedocbudget'), 'add_empty' => true)),
      'id_budget'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mnt'               => new sfWidgetFormInputText(),
      'mntengage'         => new sfWidgetFormInputText(),
      'mntrelicat'        => new sfWidgetFormInputText(),
      'mntnet'            => new sfWidgetFormInputText(),
      'id_documentbudget' => new sfWidgetFormInputText(),
      'id_declaration'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Declaration'), 'add_empty' => true)),
      'annule'            => new sfWidgetFormInputCheckbox(),
      'mntresteresilier'  => new sfWidgetFormInputText(),
      'mntconsomme'       => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'            => new sfValidatorInteger(array('required' => false)),
      'datecreation'      => new sfValidatorDate(array('required' => false)),
      'id_type'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedocbudget'), 'column' => 'id', 'required' => false)),
      'id_budget'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'mnt'               => new sfValidatorNumber(array('required' => false)),
      'mntengage'         => new sfValidatorNumber(array('required' => false)),
      'mntrelicat'        => new sfValidatorNumber(array('required' => false)),
      'mntnet'            => new sfValidatorNumber(array('required' => false)),
      'id_documentbudget' => new sfValidatorInteger(array('required' => false)),
      'id_declaration'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Declaration'), 'column' => 'id', 'required' => false)),
      'annule'            => new sfValidatorBoolean(array('required' => false)),
      'mntresteresilier'  => new sfValidatorNumber(array('required' => false)),
      'mntconsomme'       => new sfValidatorNumber(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentbudget[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentbudget';
  }

}
