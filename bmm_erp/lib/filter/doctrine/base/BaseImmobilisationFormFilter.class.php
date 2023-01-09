<?php

/**
 * Immobilisation filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImmobilisationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'numero' => new sfWidgetFormFilterInput(),
            'reference' => new sfWidgetFormFilterInput(),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datemisajour' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'id_nature' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Nature'), 'add_empty' => true)),
            'id_fabricant' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'add_empty' => true)),
            'designation' => new sfWidgetFormFilterInput(),
            'id_marque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marqueimmobilisation'), 'add_empty' => true)),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeimmobilsation'), 'add_empty' => true)),
            'id_typeaffectationimmo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'add_empty' => true)),
            'etat' => new sfWidgetFormChoice(array('choices' => array('-1' => "", '0' => 'Non Valide', '1' => 'Valide'))),
            'id_fournisseur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'numerofacture' => new sfWidgetFormFilterInput(),
            'dateacquisition' => new sfWidgetFormFilterInput(array()),
            'prixhtva' => new sfWidgetFormFilterInput(),
            'tva' => new sfWidgetFormFilterInput(),
            'mntttc' => new sfWidgetFormFilterInput(),
            'duree' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'add_empty' => true)),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
            'id_sousfamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamille'), 'add_empty' => true)),
            'id_pays' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'id_site' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
            'id_etage' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'add_empty' => true)),
            'id_bureaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'adresse' => new sfWidgetFormFilterInput(),
            'comptecomptabel' => new sfWidgetFormFilterInput(),
            'tauxammortisement' => new sfWidgetFormFilterInput(),
            'modeamortisement' => new sfWidgetFormFilterInput(),
            'sourcefinancement' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'numero' => new sfValidatorPass(array('required' => false)),
            'reference' => new sfValidatorPass(array('required' => false)),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datemisajour' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'id_nature' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Nature'), 'column' => 'id')),
            'id_fabricant' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fabricant'), 'column' => 'id')),
            'designation' => new sfValidatorPass(array('required' => false)),
            'id_marque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Marqueimmobilisation'), 'column' => 'id')),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeimmobilsation'), 'column' => 'id')),
            'id_typeaffectationimmo' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeaffectationimmo'), 'column' => 'id')),
            'id_fournisseur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'etat' => new sfValidatorString(array('required' => false)),
            'numerofacture' => new sfValidatorPass(array('required' => false)),
            'dateacquisition' => new sfValidatorPass(array('required' => false)),
            'prixhtva' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'tva' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'mntttc' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'duree' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_categorie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categoerie'), 'column' => 'id')),
            'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famille'), 'column' => 'id')),
            'id_sousfamille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousfamille'), 'column' => 'id')),
            'id_pays' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
            'id_site' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
            'id_etage' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etage'), 'column' => 'id')),
            'id_bureaux' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
            'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'adresse' => new sfValidatorPass(array('required' => false)),
            'comptecomptabel' => new sfValidatorPass(array('required' => false)),
            'tauxammortisement' => new sfValidatorPass(array('required' => false)),
            'modeamortisement' => new sfValidatorPass(array('required' => false)),
            'sourcefinancement' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('immobilisation_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Immobilisation';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'numero' => 'Text',
            'reference' => 'Text',
            'datecreation' => 'Date',
            'datemisajour' => 'Date',
            'id_user' => 'ForeignKey',
            'id_nature' => 'ForeignKey',
            'id_fabricant' => 'ForeignKey',
            'designation' => 'Text',
            'id_marque' => 'ForeignKey',
            'id_type' => 'ForeignKey',
            'id_fournisseur' => 'ForeignKey',
            'numerofacture' => 'Text',
            'dateacquisition' => 'Date',
            'prixhtva' => 'Number',
            'tva' => 'Number',
            'mntttc' => 'Number',
            'duree' => 'Date',
            'id_categorie' => 'ForeignKey',
            'id_famille' => 'ForeignKey',
            'id_sousfamille' => 'ForeignKey',
            'id_pays' => 'ForeignKey',
            'id_gouvernera' => 'ForeignKey',
            'id_site' => 'ForeignKey',
            'id_etage' => 'ForeignKey',
            'id_bureaux' => 'ForeignKey',
            'id_agent' => 'ForeignKey',
            'id_typeaffectationimmo' => 'ForeignKey',
            'adresse' => 'Text',
            'comptecomptabel' => 'Text',
            'tauxammortisement' => 'Text',
            'modeamortisement' => 'Text',
            'sourcefinancement' => 'Text',
        );
    }

}
