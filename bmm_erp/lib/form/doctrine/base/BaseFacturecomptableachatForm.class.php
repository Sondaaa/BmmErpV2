<?php

/**
 * Facturecomptableachat form base class.
 *
 * @method Facturecomptableachat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseFacturecomptableachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'date'              => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'reference'         => new sfWidgetFormInputText(),
      'totalht'           => new sfWidgetFormInputText(),
      'totaltva'          => new sfWidgetFormInputText(),
      'timbre'            => new sfWidgetFormInputText(),
      'id_comptecharge'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'totalttc'          => new sfWidgetFormInputText(),
      'id_dossier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'dateimportation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'saisie'            => new sfWidgetFormInputText(),
      'id_facture'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_fournisseur'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_devise'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_piececomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'            => new sfWidgetFormInputText(),
      'libelle'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'reference'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'totalht'           => new sfValidatorNumber(array('required' => false)),
      'totaltva'          => new sfValidatorNumber(array('required' => false)),
      'timbre'            => new sfValidatorNumber(array('required' => false)),
      'id_comptecharge'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'totalttc'          => new sfValidatorNumber(array('required' => false)),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'dateimportation'   => new sfValidatorDate(array('required' => false)),
      'saisie'            => new sfValidatorInteger(array('required' => false)),
      'id_facture'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'id_fournisseur'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'id_devise'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'column' => 'id', 'required' => false)),
      'id_piececomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id', 'required' => false)),
      'numero'            => new sfValidatorInteger(array('required' => false)),
      'libelle'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facturecomptableachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facturecomptableachat';
  }

}
