<?php

/**
 * Adressefrs form base class.
 *
 * @method Adressefrs getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdressefrsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'adrs'       => new sfWidgetFormInputText(),
      'codepostal' => new sfWidgetFormInputText(),
      'id_pays'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_gouv'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'lat'        => new sfWidgetFormInputText(),
      'lngitude'   => new sfWidgetFormInputText(),
      'id_frs'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'adrs'       => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'codepostal' => new sfValidatorInteger(array('required' => false)),
      'id_pays'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'required' => false)),
      'id_gouv'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
      'lat'        => new sfValidatorInteger(array('required' => false)),
      'lngitude'   => new sfValidatorInteger(array('required' => false)),
      'id_frs'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adressefrs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressefrs';
  }

}
