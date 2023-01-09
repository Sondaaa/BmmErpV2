<?php

/**
 * Recapbudget form base class.
 *
 * @method Recapbudget getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseRecapbudgetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_rubrique'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'id_budget'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'lib_rubrique'    => new sfWidgetFormTextarea(),
      'annees_exercice' => new sfWidgetFormInputText(),
      'date_creation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_ligrubtitre'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mois'            => new sfWidgetFormInputText(),
      'mnt_allouer'     => new sfWidgetFormInputText(),
      'mnt_encager'     => new sfWidgetFormInputText(),
      'mnt_maiement'    => new sfWidgetFormInputText(),
      'relicat_engager' => new sfWidgetFormInputText(),
      'relicat_paiment' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_rubrique'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id', 'required' => false)),
      'id_budget'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id', 'required' => false)),
      'lib_rubrique'    => new sfValidatorString(array('required' => false)),
      'annees_exercice' => new sfValidatorInteger(array('required' => false)),
      'date_creation'   => new sfValidatorDate(array('required' => false)),
      'id_ligrubtitre'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'mois'            => new sfValidatorInteger(array('required' => false)),
      'mnt_allouer'     => new sfValidatorNumber(array('required' => false)),
      'mnt_encager'     => new sfValidatorNumber(array('required' => false)),
      'mnt_maiement'    => new sfValidatorNumber(array('required' => false)),
      'relicat_engager' => new sfValidatorNumber(array('required' => false)),
      'relicat_paiment' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recapbudget[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recapbudget';
  }

}
