<?php

/**
 * Contratouvrier form base class.
 *
 * @method Contratouvrier getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContratouvrierForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'daterecrutement' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_ouvrier' =>  new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
            'id_specialteouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'add_empty' => true)),
            'id_chantier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
            'id_lieuaffetation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'add_empty' => true)),
            'montant' => new sfWidgetFormInputText(),
            'datedebutcontrat' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefincontrat' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_situationadmini' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'nbjour' => new sfWidgetFormInputText(),
            'montnattot' => new sfWidgetFormInputText(),
		    'id_retraite'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'add_empty' => true)),
			'dateretraite'        =>new sfWidgetFormInputText(),
            
            'id_salairejouralier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salairejournalier'), 'add_empty' => true)),
   
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'daterecrutement' => new sfValidatorDate(array('required' => false)),
            'id_ouvrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'required' => false)),
            'id_specialteouvrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'required' => false)),
            'id_chantier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'required' => false)),
            'id_lieuaffetation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'required' => false)),
            'montant' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datedebutcontrat' => new sfValidatorDate(array('required' => false)),
            'datefincontrat' => new sfValidatorDate(array('required' => false)),
            'id_situationadmini' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'required' => false)),
            'id_projet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
            'nbjour' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'montnattot' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
			'id_retraite'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'required' => false)),
			'dateretraite'        => new sfValidatorDate(array('required' => false)),            
            'id_salairejouralier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Salairejournalier'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contratouvrier[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contratouvrier';
    }

}
