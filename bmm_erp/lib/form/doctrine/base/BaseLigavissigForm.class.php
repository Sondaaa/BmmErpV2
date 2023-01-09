<?php

/**
 * Ligavissig form base class.
 *
 * @method Ligavissig getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLigavissigForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_visa'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_doc'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'datevisa'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'etatvalide' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_visa'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'required' => false)),
      'id_doc'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
      'datevisa'   => new sfValidatorDate(array('required' => false)),
      'etatvalide' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligavissig[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligavissig';
  }

}
