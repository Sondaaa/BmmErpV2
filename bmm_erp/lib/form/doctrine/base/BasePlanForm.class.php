<?php

/**
 * Plan form base class.
 *
 * @method Plan getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlanForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_planing'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'datedebut'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefi'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montanthtt'   => new sfWidgetFormInputText(),
      'montanttc'    => new sfWidgetFormInputText(),
      'id_organisme' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organisme'), 'add_empty' => true)),
      'id_formateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_planing'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'required' => false)),
      'datedebut'    => new sfValidatorDate(array('required' => false)),
      'datefi'       => new sfValidatorDate(array('required' => false)),
      'montanthtt'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montanttc'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_organisme' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organisme'), 'required' => false)),
      'id_formateur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plan';
  }

}
