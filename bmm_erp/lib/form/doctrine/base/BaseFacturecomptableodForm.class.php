<?php

/**
 * Facturecomptableod form base class.
 *
 * @method Facturecomptableod getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacturecomptableodForm extends BaseFormDoctrine
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
      'id_fournisseur'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_devise'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_piececomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'add_empty' => true)),
      'numero'            => new sfWidgetFormInputText(),
      'id_compteretenue'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_certfificat'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Certificatretenue'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'              => new sfValidatorDate(array('required' => false)),
      'reference'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'totalht'           => new sfValidatorNumber(array('required' => false)),
      'totaltva'          => new sfValidatorNumber(array('required' => false)),
      'timbre'            => new sfValidatorNumber(array('required' => false)),
      'totalttc'          => new sfValidatorNumber(array('required' => false)),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'required' => false)),
      'dateimportation'   => new sfValidatorDate(array('required' => false)),
      'saisie'            => new sfValidatorInteger(array('required' => false)),
      'id_facture'        => new sfValidatorInteger(array('required' => false)),
      'id_fournisseur'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
      'id_devise'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'required' => false)),
      'id_piececomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piececomptable'), 'required' => false)),
      'numero'            => new sfValidatorInteger(array('required' => false)),
      'id_compteretenue'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'required' => false)),
      'id_certfificat'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Certificatretenue'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facturecomptableod[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facturecomptableod';
  }

}
