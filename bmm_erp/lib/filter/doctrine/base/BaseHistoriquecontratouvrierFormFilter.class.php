<?php

/**
 * Historiquecontratouvrier filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquecontratouvrierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'daterecrutement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datedebutcontrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datefoncontrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'montant' => new sfWidgetFormFilterInput(),
            'id_specialite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'add_empty' => true)),
            'id_lieu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'add_empty' => true)),
            'id_chantier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
            'id_situtaion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'add_empty' => true)),
            'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
            'nbjour' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
            'montanttotal' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
 
            
            ));

        $this->setValidators(array(
            'daterecrutement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datedebutcontrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefoncontrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'montant' => new sfValidatorPass(array('required' => false)),
            'id_specialite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialiteouvrier'), 'column' => 'id')),
            'id_lieu' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'column' => 'id')),
            'id_chantier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantier'), 'column' => 'id')),
            'id_situtaion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Situationadminouvrier'), 'column' => 'id')),
            'id_contratouvrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id')),
            'nbjour' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id')),
             'montanttotal' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id')),
 
            
            ));

        $this->widgetSchema->setNameFormat('historiquecontratouvrier_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Historiquecontratouvrier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'daterecrutement' => 'Date',
            'datedebutcontrat' => 'Date',
            'datefoncontrat' => 'Date',
            'montant' => 'Text',
            
            'montanttotal' => 'Text',
            'id_specialite' => 'ForeignKey',
            'id_lieu' => 'ForeignKey',
            'id_chantier' => 'ForeignKey',
            'id_situtaion' => 'ForeignKey',
            'id_contratouvrier' => 'ForeignKey',
        );
    }

}
