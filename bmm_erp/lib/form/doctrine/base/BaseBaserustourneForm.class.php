<?php

/**
 * Baserustourne form base class.
 *
 * @method Baserustourne getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBaserustourneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'libelle'         => new sfWidgetFormInputText(),
      'id_sousrubrique' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_sousrubrique' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('baserustourne[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Baserustourne';
  }

}
