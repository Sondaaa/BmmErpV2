<?php

/**
 * Papierordrepostal form base class.
 *
 * @method Papierordrepostal getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePapierordrepostalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'repapier'      => new sfWidgetFormInputText(),
      'mnt'           => new sfWidgetFormInputText(),
      'datesignature' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'cible'         => new sfWidgetFormInputText(),
      'objet'         => new sfWidgetFormInputText(),
      'etat'          => new sfWidgetFormInputCheckbox(),
      'annule'        => new sfWidgetFormInputCheckbox(),
      'id_carnet'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetordrepostal'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repapier'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'mnt'           => new sfValidatorNumber(array('required' => false)),
      'datesignature' => new sfValidatorDate(array('required' => false)),
      'cible'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'objet'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'etat'          => new sfValidatorBoolean(array('required' => false)),
      'annule'        => new sfValidatorBoolean(array('required' => false)),
      'id_carnet'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetordrepostal'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('papierordrepostal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Papierordrepostal';
  }

}
