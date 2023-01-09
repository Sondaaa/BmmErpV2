<?php

/**
 * Carnetordrepostal form base class.
 *
 * @method Carnetordrepostal getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCarnetordrepostalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'daterecu'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'refdepart'  => new sfWidgetFormInputText(),
      'reffin'     => new sfWidgetFormInputText(),
      'id_compte'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'nbrepapier' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'refdepart'  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'reffin'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'nbrepapier' => new sfValidatorInteger(array('required' => false)),
      'daterecu'   => new sfValidatorDate(array('required' => false)),
      'id_compte'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('carnetordrepostal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carnetordrepostal';
  }

}
