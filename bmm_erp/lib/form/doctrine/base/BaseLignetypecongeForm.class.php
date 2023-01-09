<?php

/**
 * Lignetypeconge form base class.
 *
 * @method Lignetypeconge getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignetypecongeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'typetraitement'   => new sfWidgetFormInputText(),
      'nordre'           => new sfWidgetFormInputText(),
      'commisioncomplet' => new sfWidgetFormInputCheckbox(),
      'nbrjour'          => new sfWidgetFormInputText(),
      'id_typeconge'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typetraitement'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nordre'           => new sfValidatorInteger(array('required' => false)),
      'commisioncomplet' => new sfValidatorBoolean(array('required' => false)),
      'nbrjour'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_typeconge'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignetypeconge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetypeconge';
  }

}
