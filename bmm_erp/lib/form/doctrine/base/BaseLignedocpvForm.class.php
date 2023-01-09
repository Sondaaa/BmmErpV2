<?php

/**
 * Lignedocpv form base class.
 *
 * @method Lignedocpv getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignedocpvForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'id_pv'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
      'id_doc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_pv'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'column' => 'id', 'required' => false)),
      'id_doc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignedocpv[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocpv';
  }

}
