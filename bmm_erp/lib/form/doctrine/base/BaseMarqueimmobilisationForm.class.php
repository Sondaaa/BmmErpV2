<?php

/**
 * Marqueimmobilisation form base class.
 *
 * @method Marqueimmobilisation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMarqueimmobilisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormTextarea(),
      'id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('required' => false)),
      'id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('marqueimmobilisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Marqueimmobilisation';
  }

}
