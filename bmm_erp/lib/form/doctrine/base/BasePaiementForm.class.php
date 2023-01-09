<?php

/**
 * Paiement form base class.
 *
 * @method Paiement getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePaiementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_agents'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_contribution'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'tfp'                  => new sfWidgetFormInputCheckbox(),
      'foprolos'             => new sfWidgetFormInputCheckbox(),
      'mois'                 => new sfWidgetFormInputText(),
      'annee'                => new sfWidgetFormInputText(),
      'salairenet'           => new sfWidgetFormInputText(),
      'netapayer'            => new sfWidgetFormInputText(),
      'id_dossier'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'netsociale'           => new sfWidgetFormInputText(),
      'salaireimposable'     => new sfWidgetFormInputText(),
      'abattementfraaisprof' => new sfWidgetFormInputText(),
      'abattement'           => new sfWidgetFormInputText(),
      'retenueimposable'     => new sfWidgetFormInputText(),
      'imposablemensuel'     => new sfWidgetFormInputText(),
      'abattementenfant'     => new sfWidgetFormInputText(),
      'salairebrut'          => new sfWidgetFormInputText(),
      'totalretenue'         => new sfWidgetFormInputText(),
      'id_entetpaie'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Entetepaie'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_contribution'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id', 'required' => false)),
      'tfp'                  => new sfValidatorBoolean(array('required' => false)),
      'foprolos'             => new sfValidatorBoolean(array('required' => false)),
      'mois'                 => new sfValidatorInteger(array('required' => false)),
      'annee'                => new sfValidatorInteger(array('required' => false)),
      'salairenet'           => new sfValidatorNumber(array('required' => false)),
      'netapayer'            => new sfValidatorNumber(array('required' => false)),
      'id_dossier'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'netsociale'           => new sfValidatorNumber(array('required' => false)),
      'salaireimposable'     => new sfValidatorNumber(array('required' => false)),
      'abattementfraaisprof' => new sfValidatorNumber(array('required' => false)),
      'abattement'           => new sfValidatorNumber(array('required' => false)),
      'retenueimposable'     => new sfValidatorNumber(array('required' => false)),
      'imposablemensuel'     => new sfValidatorNumber(array('required' => false)),
      'abattementenfant'     => new sfValidatorNumber(array('required' => false)),
      'salairebrut'          => new sfValidatorNumber(array('required' => false)),
      'totalretenue'         => new sfValidatorNumber(array('required' => false)),
      'id_entetpaie'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Entetepaie'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('paiement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paiement';
  }

}
