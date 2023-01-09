<?php

/**
 * Historiquesalaire form base class.
 *
 * @method Historiquesalaire getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoriquesalaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'salairebase'    => new sfWidgetFormInputText(),
      'datemodification' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_contrat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_salaire'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'salairebase'    => new sfValidatorNumber(array('required' => false)),
      'datemodification' => new sfValidatorDate(array('required' => false)),
      'id_contrat'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
      'id_salaire'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquesalaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquesalaire';
  }

}
