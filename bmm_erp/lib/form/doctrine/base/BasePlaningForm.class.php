<?php

/**
 * Planing form base class.
 *
 * @method Planing getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlaningForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'montantttc'      => new sfWidgetFormInputText(),
      'montanttotalht'  => new sfWidgetFormInputText(),
      'datedebutentete' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefinentete'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'objet'           => new sfWidgetFormInputText(),
      'annee'           => new sfWidgetFormInputText(),
      'montantrealise'  => new sfWidgetFormInputText(),
      'elignible'       => new sfWidgetFormInputCheckbox(),
      'noneligibletfp'  => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'montantttc'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montanttotalht'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datedebutentete' => new sfValidatorDate(array('required' => false)),
      'datefinentete'   => new sfValidatorDate(array('required' => false)),
      'objet'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'annee'           => new sfValidatorInteger(array('required' => false)),
      'montantrealise'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'elignible'       => new sfValidatorBoolean(array('required' => false)),
      'noneligibletfp'  => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('planing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Planing';
  }

}
