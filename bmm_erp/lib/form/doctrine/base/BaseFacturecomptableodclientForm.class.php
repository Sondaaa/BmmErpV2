<?php

/**
 * Facturecomptableodclient form base class.
 *
 * @method Facturecomptableodclient getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseFacturecomptableodclientForm extends BaseFormDoctrine
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
      'totalttc'          => new sfWidgetFormInputText(),
      'id_dossier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'dateimportation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'saisie'            => new sfWidgetFormInputText(),
      'id_facture'        => new sfWidgetFormInputText(),
      'id_client'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'id_devise'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_piececomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'            => new sfWidgetFormInputText(),
      'id_compteretenue'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'reference'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'totalht'           => new sfValidatorNumber(array('required' => false)),
      'totaltva'          => new sfValidatorNumber(array('required' => false)),
      'timbre'            => new sfValidatorNumber(array('required' => false)),
      'totalttc'          => new sfValidatorNumber(array('required' => false)),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'dateimportation'   => new sfValidatorDate(array('required' => false)),
      'saisie'            => new sfValidatorInteger(array('required' => false)),
      'id_facture'        => new sfValidatorInteger(array('required' => false)),
      'id_client'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'column' => 'id', 'required' => false)),
      'id_devise'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'column' => 'id', 'required' => false)),
      'id_piececomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'column' => 'id', 'required' => false)),
      'numero'            => new sfValidatorInteger(array('required' => false)),
      'id_compteretenue'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facturecomptableodclient[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facturecomptableodclient';
  }

}
