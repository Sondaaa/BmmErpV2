<?php

/**
 * Demandeur form base class.
 *
 * @method Demandeur getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDemandeurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_agent'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_service'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
      'id_unite'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
      'libelle'          => new sfWidgetFormTextarea(),
      'id_direction'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'id_sousdirection' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousdirection'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agent'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_service'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'column' => 'id', 'required' => false)),
      'id_unite'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'column' => 'id', 'required' => false)),
      'libelle'          => new sfValidatorString(array('required' => false)),
      'id_direction'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
      'id_sousdirection' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousdirection'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demandeur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandeur';
  }

}
