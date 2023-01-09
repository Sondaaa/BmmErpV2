<?php

/**
 * Ligneoperationcaisse filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneoperationcaisseFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
		        $array = array("Actif" => "Actif", "Inactif" => "Inactif", "Ordonnonce" => "Ordonnonce");

        $this->setWidgets(array(
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
            'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorieoperation'), 'add_empty' => true)),
            'dateoperation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'mntoperation' => new sfWidgetFormFilterInput(),
            'id_docachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'table_method' => 'getDocumentsachatbdc', 'add_empty' => true)),
            'id_caisse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'numeroo' => new sfWidgetFormFilterInput(),
            'chequen' => new sfWidgetFormFilterInput(),
            'objet' => new sfWidgetFormFilterInput(),
            'id_budget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
            'id_demarcheur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demarcheur'), 'add_empty' => true)),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
     'etat' => new sfWidgetFormChoice(array('choices' => $array)),
 'retenuetva' => new sfWidgetFormFilterInput(),
  'retenueirrp' => new sfWidgetFormFilterInput(),
	 ));

        $this->setValidators(array(
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeoperation'), 'column' => 'id')),
            'id_categorie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorieoperation'), 'column' => 'id')),
            'dateoperation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'mntoperation' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_docachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
            'id_caisse' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'numeroo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'chequen' => new sfValidatorPass(array('required' => false)),
            'objet' => new sfValidatorPass(array('required' => false)),
            'id_budget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
            'id_demarcheur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demarcheur'), 'column' => 'id')),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
           'retenuetva' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    'retenueirrp' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	 'etat' => new sfValidatorPass(array('required' => false)),
	   ));

        $this->widgetSchema->setNameFormat('ligneoperationcaisse_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Ligneoperationcaisse';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_type' => 'ForeignKey',
            'id_categorie' => 'ForeignKey',
            'dateoperation' => 'Date',
            'mntoperation' => 'Number',
            'id_docachat' => 'ForeignKey',
            'id_caisse' => 'ForeignKey',
            'numeroo' => 'Number',
            'chequen' => 'Text',
            'objet' => 'Text',
            'id_budget' => 'ForeignKey',
            'id_demarcheur' => 'ForeignKey',
            'id_user' => 'ForeignKey',
        );
    }

}
