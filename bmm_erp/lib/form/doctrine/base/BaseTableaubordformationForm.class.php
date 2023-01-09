<?php

/**
 * Tableaubordformation form base class.
 *
 * @method Tableaubordformation getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTableaubordformationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_plan'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'id_ristourne'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ristourne'), 'add_empty' => true)),
      'nbrjour'          => new sfWidgetFormInputText(),
      'nbrheure'         => new sfWidgetFormInputText(),
      'montantristourne' => new sfWidgetFormInputText(),
      'montantsociete'   => new sfWidgetFormInputText(),
      'tva'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_plan'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'required' => false)),
      'id_ristourne'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ristourne'), 'required' => false)),
      'nbrjour'          => new sfValidatorInteger(array('required' => false)),
      'nbrheure'         => new sfValidatorInteger(array('required' => false)),
      'montantristourne' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montantsociete'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tva'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tableaubordformation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tableaubordformation';
  }

}
