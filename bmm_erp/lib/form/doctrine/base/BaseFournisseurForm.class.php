<?php

/**
 * Fournisseur form base class.
 *
 * @method Fournisseur getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseFournisseurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $etats = array(
      'Actif',
      'Bloqué',
    );
    $assujtva_tva = array("1" => "Oui", "0" => "Non");
    $numero_fiche = '';
    $date_creation = date('Y-m-d');
    if ($this->getObject()->isNew()) {
      $nbre_frs = FournisseurTable::getInstance()->findAll()->count() + 1;
      $numero_fiche = sprintf('%05d', $nbre_frs);
    } else {
      $numero_fiche = $this->getObject()->getNfiche();
      $date_creation = $this->getObject()->getDatecreation();
    }

    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'reference'         => new sfWidgetFormInputText(),
      'notecloture'       => new sfWidgetFormTextarea(),
      'nom'               => new sfWidgetFormInputText(),
      'prenom'            => new sfWidgetFormInputText(),
      'rs'                => new sfWidgetFormInputText(),
      'mail'              => new sfWidgetFormInputText(),
      'tel'               => new sfWidgetFormInputText(),
      'gsm'               => new sfWidgetFormInputText(),
      'id_activite'       => new sfWidgetFormDoctrineChoice(array('model' => 'Activitetiers', 'table_method' => 'getChildActivite', 'add_empty' => true)),
      'nfiche'            => new sfWidgetFormInputText(array(), array('value' => $numero_fiche)),
      'id_user'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'typefournisseur'   => new sfWidgetFormInputText(),
      'datecreation'      => new sfWidgetFormInputText(array(), array('type' => 'date', 'value' => $date_creation)),
      'datemisajour'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'etatfrs'           => new sfWidgetFormChoice(array('choices' => $etats,  'expanded' => true)),
      'codefrs'           => new sfWidgetFormInputText(),
      'adr'               => new sfWidgetFormInputText(),
      'id_gouv'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_famillearticle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familleartfrs'), 'add_empty' => true)),
      'observation'       => new sfWidgetFormTextarea(),
      'compteg'           => new sfWidgetFormInputText(),
      'comptean'          => new sfWidgetFormInputText(),
      'valeurfodec'       => new sfWidgetFormInputText(),
      'assujtva'          => new sfWidgetFormChoice(array('choices' => $assujtva_tva)),
      'fodec'             => new sfWidgetFormInputCheckbox(),
      'id_adresse'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'id_plancomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'rib'               => new sfWidgetFormInputText(),
      'id_naturecompte'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'matriculefiscale'  => new sfWidgetFormInputText(),
      'certificatrs'      => new sfWidgetFormInputCheckbox(),
      'id_dossier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'id_banque'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'add_empty' => true)),
      'fax'               => new sfWidgetFormInputText(),
	   'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'user_updated'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur_10'), 'add_empty' => true)),
   
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference'         => new sfValidatorString(array('required' => false)),
      'notecloture'       => new sfValidatorString(array('required' => false)),
      'nom'               => new sfValidatorString(array('required' => false)),
      'prenom'            => new sfValidatorString(array('required' => false)),
      'rs'                => new sfValidatorString(array('required' => false)),
      'mail'              => new sfValidatorString(array('required' => false)),
      'tel'               => new sfValidatorString(array('required' => false)),
      'gsm'               => new sfValidatorString(array('required' => false)),
      'id_activite'       => new sfValidatorDoctrineChoice(array('model' => 'Activitetiers', 'column' => 'id', 'required' => false)),
      'nfiche'            => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id_user'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'typefournisseur'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'datecreation'      => new sfValidatorDate(array('required' => false)),
      'datemisajour'      => new sfValidatorDate(array('required' => false)),
      'etatfrs'           => new sfValidatorString(array('required' => false)),
      'codefrs'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'adr'               => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_gouv'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id', 'required' => false)),
      'id_famillearticle' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Familleartfrs'), 'column' => 'id', 'required' => false)),
      'observation'       => new sfValidatorString(array('required' => false)),
      'compteg'           => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'comptean'          => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'assujtva'          => new sfValidatorPass(array('required' => false)),
      'fodec'             => new sfValidatorPass(array('required' => false)),
      'valeurfodec'       => new sfValidatorNumber(array('required' => false)),
      'id_adresse'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'column' => 'id', 'required' => false)),
      'id_plancomptable'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'rib'               => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'id_naturecompte'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id', 'required' => false)),
      'matriculefiscale'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'certificatrs'      => new sfValidatorBoolean(array('required' => false)),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'id_banque'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'column' => 'id', 'required' => false)),
      'fax'               => new sfValidatorString(array('max_length' => 25, 'required' => false)),
	    'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'user_updated'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur_10'), 'required' => false)),
  
    ));

    $this->widgetSchema->setNameFormat('fournisseur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }
}
