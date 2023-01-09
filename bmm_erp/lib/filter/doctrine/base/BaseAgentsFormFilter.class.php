<?php

/**
 * Agents filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAgentsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'nomcomplet' => new sfWidgetFormFilterInput(),
            'idrh' => new sfWidgetFormFilterInput(),
            'cin' => new sfWidgetFormFilterInput(),
            'gsm' => new sfWidgetFormFilterInput(),
            'mail' => new sfWidgetFormFilterInput(),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familleagent'), 'add_empty' => true)),
            'prenom' => new sfWidgetFormFilterInput(),
            'daten' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_gouvn' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'prenompere' => new sfWidgetFormFilterInput(),
            'prenomgp' => new sfWidgetFormFilterInput(),
            'nompmere' => new sfWidgetFormFilterInput(),
            'codepostal' => new sfWidgetFormFilterInput(),
            'longeur' => new sfWidgetFormFilterInput(),
            'idpersonnel' => new sfWidgetFormFilterInput(),
            'cip' => new sfWidgetFormFilterInput(),
            'dates' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'photo' => new sfWidgetFormFilterInput(),
            'accuetiv' => new sfWidgetFormFilterInput(),
            'id_type_permis' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis'), 'add_empty' => true)),
            'id_niveauxage' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauxage'), 'add_empty' => true)),
            'datenaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'lieunaissance' => new sfWidgetFormFilterInput(),
            'id_niveaueducatif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'add_empty' => true)),
            'id_sexe' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'add_empty' => true)),
            'id_etatcivil' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'add_empty' => true)),
            'adresse' => new sfWidgetFormFilterInput(),
            'etatmulitaire' => new sfWidgetFormFilterInput(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeagents'), 'add_empty' => true)),
            'id_pays' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
            'idcnss' => new sfWidgetFormFilterInput(),
            'dateaffiliation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'nbrenfants' => new sfWidgetFormFilterInput(),
            'rib' => new sfWidgetFormFilterInput(),
            'cheffamille' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'age' => new sfWidgetFormFilterInput(),
            'regroupement' => new sfWidgetFormFilterInput(),
            'id_regrouppement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regroupementagents'), 'add_empty' => true)),
            'active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'id_motifabsence' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Motifabsenceinactive'), 'add_empty' => true)),
            'datesortie' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_codesociale' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
            'id_typepermis' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis_14'), 'add_empty' => true)),
            'id_dossier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'nomcomplet' => new sfValidatorPass(array('required' => false)),
            'idrh' => new sfValidatorPass(array('required' => false)),
            'cin' => new sfValidatorPass(array('required' => false)),
            'gsm' => new sfValidatorPass(array('required' => false)),
            'mail' => new sfValidatorPass(array('required' => false)),
            'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Familleagent'), 'column' => 'id')),
            'prenom' => new sfValidatorPass(array('required' => false)),
            'daten' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_gouvn' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
            'prenompere' => new sfValidatorPass(array('required' => false)),
            'prenomgp' => new sfValidatorPass(array('required' => false)),
            'nompmere' => new sfValidatorPass(array('required' => false)),
            'codepostal' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'longeur' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'idpersonnel' => new sfValidatorPass(array('required' => false)),
            'cip' => new sfValidatorPass(array('required' => false)),
            'dates' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'photo' => new sfValidatorPass(array('required' => false)),
            'accuetiv' => new sfValidatorPass(array('required' => false)),
            'id_type_permis' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typepermis'), 'column' => 'id')),
            'id_niveauxage' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Niveauxage'), 'column' => 'id')),
            'datenaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'lieunaissance' => new sfValidatorPass(array('required' => false)),
            'id_niveaueducatif' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Niveaueducatif'), 'column' => 'id')),
            'id_sexe' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sexe'), 'column' => 'id')),
            'id_etatcivil' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etatcivil'), 'column' => 'id')),
            'adresse' => new sfValidatorPass(array('required' => false)),
            'etatmulitaire' => new sfValidatorPass(array('required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeagents'), 'column' => 'id')),
            'id_pays' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
            'idcnss' => new sfValidatorPass(array('required' => false)),
            'dateaffiliation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nbrenfants' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'rib' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'cheffamille' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'age' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'regroupement' => new sfValidatorPass(array('required' => false)),
            'id_regrouppement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regroupementagents'), 'column' => 'id')),
            'active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'id_motifabsence' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Motifabsenceinactive'), 'column' => 'id')),
            'datesortie' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_codesociale' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id')),
            'id_typepermis' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typepermis_14'), 'column' => 'id')),
            'id_dossier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('agents_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Agents';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'nomcomplet' => 'Text',
            'idrh' => 'Text',
            'cin' => 'Text',
            'gsm' => 'Text',
            'mail' => 'Text',
            'id_famille' => 'ForeignKey',
            'prenom' => 'Text',
            'daten' => 'Date',
            'id_gouvn' => 'ForeignKey',
            'id_gouvernerat' => 'ForeignKey',
            'prenompere' => 'Text',
            'prenomgp' => 'Text',
            'nompmere' => 'Text',
            'codepostal' => 'Number',
            'longeur' => 'Number',
            'idpersonnel' => 'Text',
            'cip' => 'Text',
            'dates' => 'Date',
            'photo' => 'Text',
            'accuetiv' => 'Text',
            'id_type_permis' => 'ForeignKey',
            'id_niveauxage' => 'ForeignKey',
            'datenaissance' => 'Date',
            'lieunaissance' => 'Text',
            'id_niveaueducatif' => 'ForeignKey',
            'id_sexe' => 'ForeignKey',
            'id_etatcivil' => 'ForeignKey',
            'adresse' => 'Text',
            'etatmulitaire' => 'Text',
            'id_type' => 'ForeignKey',
            'id_pays' => 'ForeignKey',
            'idcnss' => 'Text',
            'dateaffiliation' => 'Date',
            'nbrenfants' => 'Number',
            'rib' => 'Number',
            'age' => 'Text',
            'regroupement' => 'Text',
        );
    }

}
