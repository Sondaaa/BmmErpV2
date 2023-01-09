<?php

/**
 * Parametragetypedoc form base class.
 *
 * @method Parametragetypedoc getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseParametragetypedocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_avis'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
      'id_visa'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_typedoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_avis'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'column' => 'id', 'required' => false)),
      'id_visa'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'column' => 'id', 'required' => false)),
      'id_typedoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametragetypedoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametragetypedoc';
  }

}
