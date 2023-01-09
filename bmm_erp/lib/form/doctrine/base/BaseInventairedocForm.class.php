<?php

/**
 * Inventairedoc form base class.
 *
 * @method Inventairedoc getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseInventairedocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_doc'     => new sfWidgetFormInputText(),
      'id_empl'    => new sfWidgetFormInputText(),
      'qteexstant' => new sfWidgetFormInputText(),
      'qtereel'    => new sfWidgetFormInputText(),
      'ecart'      => new sfWidgetFormInputText(),
      'rq'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_doc'     => new sfValidatorInteger(array('required' => false)),
      'id_empl'    => new sfValidatorInteger(array('required' => false)),
      'qteexstant' => new sfValidatorInteger(array('required' => false)),
      'qtereel'    => new sfValidatorInteger(array('required' => false)),
      'ecart'      => new sfValidatorInteger(array('required' => false)),
      'rq'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inventairedoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventairedoc';
  }

}
