<?php

/**
 * Alimentationcompte form base class.
 *
 * @method Alimentationcompte getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAlimentationcompteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormDate(),
      'id_compte'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'montant'          => new sfWidgetFormInputText(),
      'id_tranchebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tranchebudget'), 'add_empty' => true)),
      'chemin'           => new sfWidgetFormTextarea(),
      'type'             => new sfWidgetFormInputText(),
      'id_sourcesbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'add_empty' => true)),
      'libellesource'    => new sfWidgetFormTextarea(),
      'id_titrebudget'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'             => new sfValidatorDate(array('required' => false)),
      'id_compte'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'required' => false)),
      'montant'          => new sfValidatorNumber(array('required' => false)),
      'id_tranchebudget' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tranchebudget'), 'required' => false)),
      'chemin'           => new sfValidatorString(array('required' => false)),
      'type'             => new sfValidatorInteger(array('required' => false)),
      'id_sourcesbudget' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'required' => false)),
      'libellesource'    => new sfValidatorString(array('required' => false)),
      'id_titrebudget'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('alimentationcompte[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alimentationcompte';
  }

}
