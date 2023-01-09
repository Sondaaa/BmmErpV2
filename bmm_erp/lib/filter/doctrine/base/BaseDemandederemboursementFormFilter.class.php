<?php

/**
 * Demandederemboursement filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandederemboursementFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_posterh' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
            'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
            'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'bloc' => new sfWidgetFormFilterInput(),
            'hopital' => new sfWidgetFormFilterInput(),
            'observation' => new sfWidgetFormFilterInput(),
            'signature' => new sfWidgetFormFilterInput(),
			  'id_hopital'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'add_empty' => true)),
'chemin'   => new sfWidgetFormFilterInput(), 
 ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_posterh' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posterh'), 'column' => 'id')),
            'id_unite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unite'), 'column' => 'id')),
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'bloc' => new sfValidatorPass(array('required' => false)),
            'hopital' => new sfValidatorPass(array('required' => false)),
            'observation' => new sfValidatorPass(array('required' => false)),
            'signature' => new sfValidatorPass(array('required' => false)),
			  'id_hopital'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hopital'), 'column' => 'id')),
      'chemin'   => new sfValidatorPass(array('required' => false)),
	 ));

        $this->widgetSchema->setNameFormat('demandederemboursement_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandederemboursement';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'id_posterh' => 'ForeignKey',
            'id_direction' => 'ForeignKey',
            'date' => 'Date',
            'bloc' => 'Text',
            'hopital' => 'Text',
            'observation' => 'Text',
        );
    }

}
