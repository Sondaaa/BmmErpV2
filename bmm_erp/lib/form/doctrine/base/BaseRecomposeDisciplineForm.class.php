<?php

/**
 * Recomposediscipline form base class.
 *
 * @method Recomposediscipline getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecomposedisciplineForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'source'           => new sfWidgetFormInputText(),
      'explication'      => new sfWidgetFormInputText(),
      'id_agents'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_typedecipline' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscpline'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'             => new sfValidatorDate(array('required' => false)),
      'source'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'explication'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_agents'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
      'id_typedecipline' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscpline'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recomposediscipline[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recomposediscipline';
  }

}
