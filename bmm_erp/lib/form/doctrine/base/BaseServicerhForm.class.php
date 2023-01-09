<?php

/**
 * Servicerh form base class.
 *
 * @method Servicerh getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseServicerhForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'libelle'          => new sfWidgetFormInputText(),
      'id_sousdirection' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousdirection'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_sousdirection' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousdirection'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('servicerh[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Servicerh';
  }

}
