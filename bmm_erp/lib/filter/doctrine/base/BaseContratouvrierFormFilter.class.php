<?php

/**
 * Contratouvrier filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContratouvrierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'daterecrutement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_ouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
            'id_specialteouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'add_empty' => true)),
            'id_chantier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
            'id_lieuaffetation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'add_empty' => true)),
            'montant' => new sfWidgetFormFilterInput(),
            'datedebutcontrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datefincontrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_situationadmini' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'nbjour' => new sfWidgetFormFilterInput(),
            'montnattot' => new sfWidgetFormFilterInput(),
			'id_retraite'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'add_empty' => true)),
			'dateretraite'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),

        ));

        $this->setValidators(array(
            'daterecrutement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_ouvrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id')),
            'id_specialteouvrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialiteouvrier'), 'column' => 'id')),
            'id_chantier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantier'), 'column' => 'id')),
            'id_lieuaffetation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'column' => 'id')),
            'montant' => new sfValidatorPass(array('required' => false)),
            'datedebutcontrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefincontrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_situationadmini' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Situationadminouvrier'), 'column' => 'id')),
            'id_projet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
            'nbjour' => new sfValidatorPass(array('required' => false)),
            'montnattot' => new sfValidatorPass(array('required' => false)),  'id_retraite'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Retraite'), 'column' => 'id')),
			'dateretraite'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
	
        ));

        $this->widgetSchema->setNameFormat('contratouvrier_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contratouvrier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'daterecrutement' => 'Date',
            'id_ouvrier' => 'ForeignKey',
            'id_specialteouvrier' => 'ForeignKey',
            'id_chantier' => 'ForeignKey',
            'id_lieuaffetation' => 'ForeignKey',
            'montant' => 'Text',
            'datedebutcontrat' => 'Date',
            'datefincontrat' => 'Date',
            'id_situationadmini' => 'ForeignKey',
            'id_projet' => 'ForeignKey',
			'id_retraite'         => 'ForeignKey',
			  'dateretraite'        => 'Date',
        );
    }

}
