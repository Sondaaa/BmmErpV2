<?php

/**
 * Autoristation filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAutoristationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'hopital' => new sfWidgetFormFilterInput(),
            'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'moyen' => new sfWidgetFormFilterInput(),
            'causedevisite' => new sfWidgetFormFilterInput(),
            'reference' => new sfWidgetFormFilterInput(),
            'signatureagents' => new sfWidgetFormFilterInput(),
            'visamedecin' => new sfWidgetFormFilterInput(),
            'signaturedirecteur' => new sfWidgetFormFilterInput(),
            'decision' => new sfWidgetFormFilterInput(),
            'id_hopital' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hopital'), 'add_empty' => true)),
			'cheminsignagents'   => new sfWidgetFormFilterInput(), 
	  'cheminsigndirecteur'   => new sfWidgetFormFilterInput(), 
	  'cheminmedecin'   => new sfWidgetFormFilterInput(), 
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'hopital' => new sfValidatorPass(array('required' => false)),
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'moyen' => new sfValidatorPass(array('required' => false)),
            'causedevisite' => new sfValidatorPass(array('required' => false)),
            'reference' => new sfValidatorPass(array('required' => false)),
            'signatureagents' => new sfValidatorPass(array('required' => false)),
            'visamedecin' => new sfValidatorPass(array('required' => false)),
            'signaturedirecteur' => new sfValidatorPass(array('required' => false)),
            'decision' => new sfValidatorPass(array('required' => false)),
            'id_hopital' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hopital'), 'column' => 'id')),
'cheminsignagents'   => new sfValidatorPass(array('required' => false)),
	   'cheminsigndirecteur'   => new sfValidatorPass(array('required' => false)),
	      'cheminmedecin'   => new sfValidatorPass(array('required' => false)),       
	   ));

        $this->widgetSchema->setNameFormat('autoristation_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Autoristation';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'hopital' => 'Text',
            'date' => 'Date',
            'moyen' => 'Text',
            'causedevisite' => 'Text',
            'reference' => 'Text',
            'signatureagents' => 'Text',
            'visamedecin' => 'Text',
            'signaturedirecteur' => 'Text',
            'decision' => 'Text',
            
        );
    }

}
