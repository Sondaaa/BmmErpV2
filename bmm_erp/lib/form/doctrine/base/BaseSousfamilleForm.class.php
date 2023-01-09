<?php

/**
 * Sousfamille form base class.
 *
 * @method Sousfamille getObject() Returns the current form's model object
 *
 * @package    Commercial
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSousfamilleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'sousfamille' => new sfWidgetFormInputText(),
      'id_famille'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sousfamille' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'id_famille'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousfamille[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousfamille';
  }

}
