<?php

/**
 * Titrebudjet filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTitrebudjetFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'description' => new sfWidgetFormFilterInput(),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
            'id_source' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesbudget'), 'add_empty' => true)),
            'mntglobal' => new sfWidgetFormFilterInput(),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'etatbudget' => new sfWidgetFormFilterInput(),
            'typebudget' => new sfWidgetFormFilterInput(),
            'id_cat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorietitre'), 'add_empty' => true)),
            'pourcentageencaisser' => new sfWidgetFormFilterInput(),
            'mntexterne' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'id_projet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
            'id_direction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
            'id_source' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sourcesbudget'), 'column' => 'id')),
            'mntglobal' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'etatbudget' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'typebudget' => new sfValidatorPass(array('required' => false)),
            'id_cat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorietitre'), 'column' => 'id')),
            'pourcentageencaisser' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'mntexterne' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('titrebudjet_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Titrebudjet';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'libelle' => 'Text',
            'description' => 'Text',
            'id_projet' => 'ForeignKey',
            'id_direction' => 'ForeignKey',
            'id_source' => 'ForeignKey',
            'mntglobal' => 'Number',
            'id_user' => 'ForeignKey',
            'datecreation' => 'Date',
        );
    }

}
