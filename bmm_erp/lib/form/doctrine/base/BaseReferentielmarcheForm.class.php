<?php

/**
 * Referentielmarche form base class.
 *
 * @method Referentielmarche getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReferentielmarcheForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'libelle'       => new sfWidgetFormTextarea(),
      'url'           => new sfWidgetFormTextarea(),
      'id_utlisateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'standard'      => new sfWidgetFormTextarea(),
      'description'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'       => new sfValidatorString(array('required' => false)),
      'url'           => new sfValidatorString(array('required' => false)),
      'id_utlisateur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'standard'      => new sfValidatorString(array('required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('referentielmarche[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Referentielmarche';
  }

}
