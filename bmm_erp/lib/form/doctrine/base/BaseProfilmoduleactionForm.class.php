<?php

/**
 * Profilmoduleaction form base class.
 *
 * @method Profilmoduleaction getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfilmoduleactionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'libelle'         => new sfWidgetFormTextarea(),
      'id_profilmodule' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profilmodule'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'         => new sfValidatorString(array('required' => false)),
      'id_profilmodule' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profilmodule'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profilmoduleaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profilmoduleaction';
  }

}
