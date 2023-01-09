<?php

/**
 * Role form base class.
 *
 * @method Role getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseRoleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'role'         => new sfWidgetFormTextarea(),
      'id_famexpdes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'role'         => new sfValidatorString(array('required' => false)),
      'id_famexpdes' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('role[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

}
