<?php

/**
 * Lignetravailrapport form base class.
 *
 * @method Lignetravailrapport getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignetravailrapportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'libelle'           => new sfWidgetFormTextarea(),
      'montant'           => new sfWidgetFormInputText(),
      'id_travailrapport' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Travailrapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'           => new sfValidatorString(array('required' => false)),
      'montant'           => new sfValidatorNumber(array('required' => false)),
      'id_travailrapport' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Travailrapporttravaux'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignetravailrapport[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetravailrapport';
  }

}
