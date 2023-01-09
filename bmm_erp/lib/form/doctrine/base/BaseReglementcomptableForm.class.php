<?php

/**
 * Reglementcomptable form base class.
 *
 * @method Reglementcomptable getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReglementcomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'date'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'refrence'           => new sfWidgetFormInputText(),
      'totalht'            => new sfWidgetFormInputText(),
      'totaltva'           => new sfWidgetFormInputText(),
      'timbre'             => new sfWidgetFormInputText(),
      'totalttc'           => new sfWidgetFormInputText(),
      'id_dossier'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'dateimportation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'saisie'             => new sfWidgetFormInputText(),
      'id_piececomptable'  => new sfWidgetFormInputText(),
      'numero'             => new sfWidgetFormInputText(),
      'datevaleur'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'libelle'            => new sfWidgetFormInputText(),
      'type'               => new sfWidgetFormInputText(),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'id_banque'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'id_journal'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'add_empty' => true)),
      'id_frs'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_mouvement'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'refrence'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'totalht'            => new sfValidatorNumber(array('required' => false)),
      'totaltva'           => new sfValidatorNumber(array('required' => false)),
      'timbre'             => new sfValidatorNumber(array('required' => false)),
      'totalttc'           => new sfValidatorNumber(array('required' => false)),
      'id_dossier'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'required' => false)),
      'dateimportation'    => new sfValidatorDate(array('required' => false)),
      'saisie'             => new sfValidatorInteger(array('required' => false)),
      'id_piececomptable'  => new sfValidatorInteger(array('required' => false)),
      'numero'             => new sfValidatorInteger(array('required' => false)),
      'datevaleur'         => new sfValidatorDate(array('required' => false)),
      'libelle'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'               => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'required' => false)),
      'id_banque'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'required' => false)),
      'id_journal'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journalcomptable'), 'required' => false)),
      'id_frs'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
      'id_mouvement'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reglementcomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reglementcomptable';
  }

}
