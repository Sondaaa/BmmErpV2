<?php

/**
 * Rapporttravaux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRapporttravauxFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'annee' => new sfWidgetFormFilterInput(),
            'libelle' => new sfWidgetFormFilterInput(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typerapport'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'libelle' => new sfValidatorPass(array('required' => false)),
            'annee'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typerapport'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('rapporttravaux_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Rapporttravaux';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'date' => 'Date',
            'libelle' => 'Text',
            'annee'   => 'Number',
            'id_type' => 'ForeignKey',
        );
    }

}
