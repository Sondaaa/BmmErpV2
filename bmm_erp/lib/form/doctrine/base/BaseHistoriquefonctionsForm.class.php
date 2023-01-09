<?php

/**
 * Historiquefonctions form base class.
 *
 * @method Historiquefonctions getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseHistoriquefonctionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_contrat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_fonction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'add_empty' => true)),
      'datesysteme' => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contrat'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'column' => 'id', 'required' => false)),
      'id_fonction' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'column' => 'id', 'required' => false)),
      'datesysteme' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquefonctions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquefonctions';
  }

}
