<?php

/**
 * Parametreexpedition form base class.
 *
 * @method Parametreexpedition getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseParametreexpeditionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_exp'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'add_empty' => true)),
      'id_dest'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_2'), 'add_empty' => true)),
      'id_typecourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_exp'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'column' => 'id', 'required' => false)),
      'id_dest'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_2'), 'column' => 'id', 'required' => false)),
      'id_typecourrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametreexpedition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametreexpedition';
  }

}
