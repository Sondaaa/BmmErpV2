<?php

/**
 * Demandederemboursement form base class.
 *
 * @method Demandederemboursement getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDemandederemboursementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_agents'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_posterh'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
      'chemin'      => new sfWidgetFormTextarea(),
      'date'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'bloc'        => new sfWidgetFormInputText(),
      'hopital'     => new sfWidgetFormInputText(),
      'observation' => new sfWidgetFormTextarea(),
      'id_unite'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
      'signature'   => new sfWidgetFormInputText(),
      'id_hopital'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_posterh'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'column' => 'id', 'required' => false)),
      'chemin'      => new sfValidatorString(array('required' => false)),
      'date'        => new sfValidatorDate(array('required' => false)),
      'bloc'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'hopital'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'observation' => new sfValidatorString(array('required' => false)),
      'id_unite'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'column' => 'id', 'required' => false)),
      'signature'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_hopital'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demandederemboursement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandederemboursement';
  }

}
