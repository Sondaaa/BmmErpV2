<?php

/**
 * Contribitionpatronale form base class.
 *
 * @method Contribitionpatronale getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseContribitionpatronaleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'code'    => new sfWidgetFormInputText(),
      'libelle' => new sfWidgetFormTextarea(),
      'taux'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'libelle' => new sfValidatorString(array('required' => false)),
      'taux'    => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contribitionpatronale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contribitionpatronale';
  }

}
