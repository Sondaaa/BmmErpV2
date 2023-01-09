<?php

/**
 * Typearticle form base class.
 *
 * @method Typearticle getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTypearticleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'libelle'     => new sfWidgetFormInputText(),
      'prefixetype' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'prefixetype' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typearticle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typearticle';
  }

}
