<?php

/**
 * Parametrebilancompte form base class.
 *
 * @method Parametrebilancompte getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParametrebilancompteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'note'      => new sfWidgetFormInputText(),
      'type'      => new sfWidgetFormInputText(),
      'id_compte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
	  
	   'regrouppement'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'note'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
	  'regrouppement'      => new sfValidatorString(array('max_length' => 225, 'required' => false)),
      'type'      => new sfValidatorInteger(array('required' => false)),
      'id_compte' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametrebilancompte[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametrebilancompte';
  }

}
