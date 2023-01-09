<?php

/**
 * Lignepvfrs form base class.
 *
 * @method Lignepvfrs getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignepvfrsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'id_pv'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
      'id_frs' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_pv'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'column' => 'id', 'required' => false)),
      'id_frs' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignepvfrs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepvfrs';
  }

}
