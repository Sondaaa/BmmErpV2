<?php

/**
 * Contratachat form base class.
 *
 * @method Contratachat getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContratachatForm extends BaseFormDoctrine {

    public function setup() {
        $typelivraiton = array("0" => "Livraison Total", "1" => "Livraison Partièl");
		  $typepaiement = array("0" => "Sans Décompte", "1" => "Avec Décompte");
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'numero' => new sfWidgetFormInputText(),
            'reference' => new sfWidgetFormInputText(),
            'type' => new sfWidgetFormChoice(array('choices' => $typelivraiton)),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datesigntaure' => new sfWidgetFormInputText(array(), array('type' => 'date')),
//            'type' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'observation' => new sfWidgetFormTextarea(),
            'chemindoc' => new sfWidgetFormTextarea(),
            'id_demandeur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
            'id_typedoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
            'id_adresse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
            'id_lignedirectionsite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
            'designtaion' => new sfWidgetFormInputText(),
            'id_objet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'mht' => new sfWidgetFormInputText(),
            'mnttva' => new sfWidgetFormInputText(),
            'mnttc' => new sfWidgetFormInputText(),
            'etatdocachat' => new sfWidgetFormInputText(),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_lieu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieulivraisson'), 'add_empty' => true)),
            'montantcontrat' => new sfWidgetFormInputText(),
            'id_etatdoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'add_empty' => true)),
            'id_doc' => new sfWidgetFormInputText(),
           
         
            'id_docparent' => new sfWidgetFormInputText(),
			 'montantplanfonne'      => new sfWidgetFormInputText(),
			  'consulte'              => new sfWidgetFormInputCheckbox(),
			  'montantavenant'        => new sfWidgetFormInputText(),
			  'montantavenant'        => new sfWidgetFormInputText(),
			    'datefin'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
				'retenuegaraentie'      => new sfWidgetFormInputText(),
      'cautionement'          => new sfWidgetFormInputText(),
      'avance'                => new sfWidgetFormInputText(),
      'penalite'              => new sfWidgetFormInputText(),
      'datecommencement'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'maxpinalite'           => new sfWidgetFormInputText(),
	  'dateoservice'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datereceptionprevesoire' => new  sfWidgetFormInputText(array(), array('type' => 'date')),
      'delaidexucution'         => new sfWidgetFormInputText(),
      'periodejustifier'        => new sfWidgetFormInputText(),
      'delaicontractuelle'      => new sfWidgetFormInputText(),
      'pireodereelexecution'    => new sfWidgetFormInputText(),
      'pirioderetard'           => new sfWidgetFormInputText(),
      'anciendateios'           => new  sfWidgetFormInputText(array(), array('type' => 'date')),
	  
	  'mntpenalite'              => new sfWidgetFormInputText(),
	    'delaicontratcuel'        => new sfWidgetFormInputText(),
      'typepaiment'             =>new sfWidgetFormChoice(array('choices' => $typepaiement)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'numero' => new sfValidatorInteger(array('required' => false)),
            'reference' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datecreation' => new sfValidatorDate(array('required' => false)),
            'datesigntaure' => new sfValidatorDate(array('required' => false)),
            'observation' => new sfValidatorString(array('required' => false)),
            'chemindoc' => new sfValidatorString(array('required' => false)),
            'id_demandeur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'required' => false)),
            'id_typedoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'required' => false)),
            'id_adresse' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'required' => false)),
            'id_lignedirectionsite' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'required' => false)),
            'designtaion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_objet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'required' => false)),
            'id_projet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
            'mht' => new sfValidatorNumber(array('required' => false)),
            'mnttva' => new sfValidatorNumber(array('required' => false)),
            'mnttc' => new sfValidatorNumber(array('required' => false)),
            'etatdocachat' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_user' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
            'id_frs' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
            'id_lieu' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieulivraisson'), 'required' => false)),
            'montantcontrat' => new sfValidatorNumber(array('required' => false)),
            'id_etatdoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'required' => false)),
            'id_doc' => new sfValidatorInteger(array('required' => false)),
           
         
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_docparent' => new sfValidatorInteger(array('required' => false)),
			'montantplanfonne'      => new sfValidatorNumber(array('required' => false)),
			   'consulte'              => new sfValidatorBoolean(array('required' => false)),
			     'montantavenant'        => new sfValidatorNumber(array('required' => false)),
				 'datefin'               => new sfValidatorDate(array('required' => false)),
				 'retenuegaraentie'      => new sfValidatorNumber(array('required' => false)),
      'cautionement'          => new sfValidatorNumber(array('required' => false)),
      'avance'                => new sfValidatorNumber(array('required' => false)),
      'penalite'              => new sfValidatorNumber(array('required' => false)),
      'datecommencement'      => new sfValidatorDate(array('required' => false)),
      'maxpinalite'           => new sfValidatorNumber(array('required' => false)),
	  'dateoservice'            => new sfValidatorDate(array('required' => false)),
      'datereceptionprevesoire' => new sfValidatorDate(array('required' => false)),
      'delaidexucution'         => new sfValidatorInteger(array('required' => false)),
      'periodejustifier'        => new sfValidatorInteger(array('required' => false)),
      'delaicontractuelle'      => new sfValidatorInteger(array('required' => false)),
      'pireodereelexecution'    => new sfValidatorInteger(array('required' => false)),
      'pirioderetard'           => new sfValidatorInteger(array('required' => false)),
      'anciendateios'           => new sfValidatorDate(array('required' => false)),
	  
	   'mntpenalite'              => new sfValidatorNumber(array('required' => false)),
	    'delaicontratcuel'        => new sfValidatorInteger(array('required' => false)),
      'typepaiment'             => new sfValidatorString(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contratachat[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contratachat';
    }

}
