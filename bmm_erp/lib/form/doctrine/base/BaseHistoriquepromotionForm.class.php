<?php

/**
 * Historiquepromotion form base class.
 *
 * @method Historiquepromotion getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoriquepromotionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'dateeffet'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dategrade'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_contrat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'datesysteme' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'grade'       => new sfWidgetFormInputText(),
      'id_nature'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dateeffet'   => new sfValidatorDate(array('required' => false)),
      'dategrade'   => new sfValidatorDate(array('required' => false)),
      'id_contrat'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
      'datesysteme' => new sfValidatorDate(array('required' => false)),
      'grade'       => new sfValidatorInteger(array('required' => false)),
      'id_nature'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquepromotion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquepromotion';
  }

}
