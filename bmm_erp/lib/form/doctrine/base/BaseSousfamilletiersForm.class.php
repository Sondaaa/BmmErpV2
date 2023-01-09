<?php

/**
 * Sousfamilletiers form base class.
 *
 * @method Sousfamilletiers getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSousfamilletiersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'libelle'    => new sfWidgetFormInputText(),
      'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familletiers'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_famille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Familletiers'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousfamilletiers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousfamilletiers';
  }

}
