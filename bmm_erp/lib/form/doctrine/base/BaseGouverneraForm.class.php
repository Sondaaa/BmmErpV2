<?php

/**
 * Gouvernera form base class.
 *
 * @method Gouvernera getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGouverneraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'gouvernera' => new sfWidgetFormInputText(),
      'id_pays'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'gouvernera' => new sfValidatorString(array('required' => false)),
      'id_pays'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gouvernera[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gouvernera';
  }

}
