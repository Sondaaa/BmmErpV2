<?php

/**
 * Historiquelieudetravail form base class.
 *
 * @method Historiquelieudetravail getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseHistoriquelieudetravailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_lieu'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'datesyteme' => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'column' => 'id', 'required' => false)),
      'id_lieu'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id', 'required' => false)),
      'datesyteme' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquelieudetravail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquelieudetravail';
  }

}
