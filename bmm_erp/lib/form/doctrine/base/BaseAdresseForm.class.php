<?php

/**
 * Adresse form base class.
 *
 * @method Adresse getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdresseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'adresse'       => new sfWidgetFormTextarea(),
      'id_couvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => false)),
      'codepostal'    => new sfWidgetFormTextarea(),
      'id_frs'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'adresse'       => new sfValidatorString(array('required' => false)),
      'id_couvernera' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'))),
      'codepostal'    => new sfValidatorString(array('required' => false)),
      'id_frs'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adresse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adresse';
  }

}
