<?php

/**
 * Ordredeservice form base class.
 *
 * @method Ordredeservice getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseOrdredeserviceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'referece'       => new sfWidgetFormTextarea(),
      'object'         => new sfWidgetFormTextarea(),
      'description'    => new sfWidgetFormTextarea(),
      'id_type'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'add_empty' => true)),
      'dateios'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_benificaire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
      'delaios'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'referece'       => new sfValidatorString(array('required' => false)),
      'object'         => new sfValidatorString(array('required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'id_type'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'column' => 'id', 'required' => false)),
      'dateios'        => new sfValidatorDate(array('required' => false)),
      'id_benificaire' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'column' => 'id', 'required' => false)),
      'delaios'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ordredeservice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ordredeservice';
  }

}
