<?php

/**
 * Demandeur filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeurFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_service' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
            'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
            'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
            'id_sousdirection' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousdirection'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_service' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Servicerh'), 'column' => 'id')),
            'id_unite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unite'), 'column' => 'id')),
            'libelle' => new sfValidatorPass(array('required' => false)),
            'id_direction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
            'id_sousdirection' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousdirection'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('demandeur_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandeur';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agent' => 'ForeignKey',
            'id_service' => 'ForeignKey',
            'id_unite' => 'ForeignKey',
            'libelle' => 'Text',
            'id_direction' => 'ForeignKey',
            'id_sousdirection' => 'ForeignKey',
        );
    }

}
