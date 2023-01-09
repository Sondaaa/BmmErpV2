<?php

/**
 * Lignepvvisa form base class.
 *
 * @method Lignepvvisa getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignepvvisaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'id_visa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'add_empty' => true)),
      'id_pv'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_visa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Visaachat'), 'required' => false)),
      'id_pv'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pvdoc'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignepvvisa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignepvvisa';
  }

}
