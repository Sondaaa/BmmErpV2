<?php

/**
 * Salairedebase filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSalairedebaseFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
            'id_echelle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Echelle'), 'add_empty' => true)),
            'id_echelon' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Echelon'), 'add_empty' => true)),
            'motant' => new sfWidgetFormFilterInput(),
            'id_grade' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
            'id_souscorps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'add_empty' => true)),
            'id_corps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_categorie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorierh'), 'column' => 'id')),
            'id_echelle' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Echelle'), 'column' => 'id')),
            'id_echelon' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Echelon'), 'column' => 'id')),
            'motant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_grade' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grade'), 'column' => 'id')),
            'id_souscorps' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Souscorps'), 'column' => 'id')),
            'id_corps' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('salairedebase_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Salairedebase';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_categorie' => 'ForeignKey',
            'id_echelle' => 'ForeignKey',
            'id_echelon' => 'ForeignKey',
            'motant' => 'Number',
            'id_grade' => 'ForeignKey',
            'id_souscorps' => 'ForeignKey',
        );
    }

}
