<?php

/**
 * Contrat filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContratFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
        'dateaccusition' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'dateemposte' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'id_poste' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Poste'), 'add_empty' => true)),
        'id_typecontrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'add_empty' => true)),
        'datetitulaire' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'ncnss' => new sfWidgetFormFilterInput(),
        'observation' => new sfWidgetFormFilterInput(),
        'id_fonction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'add_empty' => true)),
        'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
        'id_grade' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
        'id_salairedebase' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'add_empty' => true)),
        'numinscri' => new sfWidgetFormFilterInput(),
        'fonctionapp' => new sfWidgetFormFilterInput(),
        'datepromotions' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'id_gouv' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
        'id_gouvernerat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernerat'), 'add_empty' => true)),
        'id_posterh' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
        'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
        'dateechelle' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'dateechelon' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'dategrade' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'dateeffet' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'id_graderec' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_10'), 'add_empty' => true)),
        'id_gradetitu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_11'), 'add_empty' => true)),
        'montant' => new sfWidgetFormFilterInput(),
        'idsalaire' => new sfWidgetFormInputText(),
        'id_lieu' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
        'id_naturepromo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'add_empty' => true)),
        'id_positionadmini' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Positionadministratif'), 'add_empty' => true)),
        'dateouverture' => new sfWidgetFormInputText(array(), array('type' => 'date')),
        'datefermeture' => new sfWidgetFormInputText(array(), array('type' => 'date')),
        'id_retratite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'add_empty' => true)),
        'dateretraite' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'id_regime' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
        'datevalidesalaire' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'montant' => new sfWidgetFormFilterInput(),
        'id_codesociale' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
        'idunique' => new sfWidgetFormFilterInput(),
        'dateaffiliation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        'salairetheorique' => new sfWidgetFormFilterInput(),
        'id_lignecodesociale' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'add_empty' => true)),
        'id_lignecontribition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'add_empty' => true)),
        'totaltauxsociale' => new sfWidgetFormFilterInput(),
        'id_contribiton' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
        'specialite' =>  new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'dateaccusition' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'dateemposte' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_poste' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Poste'), 'column' => 'id')),
            'id_typecontrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecontrat'), 'column' => 'id')),
            'datetitulaire' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'ncnss' => new sfValidatorPass(array('required' => false)),
            'observation' => new sfValidatorPass(array('required' => false)),
            'id_fonction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fonction'), 'column' => 'id')),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_grade' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grade'), 'column' => 'id')),
            'id_salairedebase' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Salairedebase'), 'column' => 'id')),
            'numinscri' => new sfValidatorPass(array('required' => false)),
            'fonctionapp' => new sfValidatorPass(array('required' => false)),
            'datepromotions' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_gouv' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
            'id_gouvernerat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernerat'), 'column' => 'id')),
            'id_posterh' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posterh'), 'column' => 'id')),
            'id_unite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unite'), 'column' => 'id')),
            'dateechelle' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'dateechelon' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'dategrade' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'dateeffet' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_graderec' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grade_10'), 'column' => 'id')),
            'id_gradetitu' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grade_11'), 'column' => 'id')),
            'montant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'idsalaire' => new sfValidatorPass(array('required' => false)),
            'id_lieu' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id')),
            'id_naturepromo' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturepromotion'), 'column' => 'id')),
            'id_positionadmini' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Positionadministratif'), 'column' => 'id')),
            'dateouverture' => new sfValidatorDate(array('required' => false)),
            'datefermeture' => new sfValidatorDate(array('required' => false)),
            'id_retratite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Retraite'), 'column' => 'id')),
            'dateretraite' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_regime' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id')),
            'datevalidesalaire' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'montant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_codesociale' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id')),
            'idunique' => new sfValidatorPass(array('required' => false)),
            'dateaffiliation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'salairetheorique' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_lignecodesociale' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignecodesociale'), 'column' => 'id')),
            'id_lignecontribition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'column' => 'id')),
            'totaltauxsociale' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_contribiton' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id')),
            'specialite' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));


        $this->widgetSchema->setNameFormat('contrat_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contrat';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'dateaccusition' => 'Date',
            'dateemposte' => 'Date',
            'id_poste' => 'ForeignKey',
            'id_typecontrat' => 'ForeignKey',
            'datetitulaire' => 'Date',
            'ncnss' => 'Text',
            'idsalaire' => 'Text',
            'observation' => 'Text',
            'id_fonction' => 'ForeignKey',
            'id_agents' => 'ForeignKey',
            'id_grade' => 'ForeignKey',
            'id_salairedebase' => 'ForeignKey',
            'statutadministratif' => 'Text',
            'numinscri' => 'Text',
            'fonctionapp' => 'Text',
            'naturepromotions' => 'Text',
            'datepromotions' => 'Date',
            'id_gouv' => 'ForeignKey',
            'id_gouvernerat' => 'ForeignKey',
            'id_posterh' => 'ForeignKey',
            'id_unite' => 'ForeignKey',
            'dateechelle' => 'Date',
            'dateechelon' => 'Date',
            'lieuaffectation' => 'Text',
            'dategrade' => 'Date',
            'dateeffet' => 'Date',
            'id_graderec' => 'ForeignKey',
            'id_gradetitu' => 'ForeignKey',
            'id_lieu' => 'ForeignKey',
            'id_naturepromo' => 'ForeignKey',
            'id_positionadmini' => 'ForeignKey',
            'id_retratite' => 'ForeignKey',
            'dateretraite' => 'Date',
            'montant' => 'Number',
            'id_regime' => 'ForeignKey',
            'datevalidesalaire' => 'Date',
            'id_codesociale' => 'ForeignKey',
            'idunique' => 'Text',
            'dateaffiliation' => 'Date',
        );
    }

}
