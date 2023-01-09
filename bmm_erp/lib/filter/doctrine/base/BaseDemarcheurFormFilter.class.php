<?php

/**
 * Demarcheur filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemarcheurFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'nomcomplet' => new sfWidgetFormFilterInput(),
            'gsm' => new sfWidgetFormFilterInput(),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'nomcomplet' => new sfValidatorPass(array('required' => false)),
            'gsm' => new sfValidatorPass(array('required' => false)),
            'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('demarcheur_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demarcheur';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'nomcomplet' => 'Text',
            'id_agent' => 'ForeignKey',
            'gsm' => 'Text',
        );
    }

}
