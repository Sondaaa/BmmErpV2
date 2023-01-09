<?php

/**
 * Jourferier filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJourferierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'jour' => new sfWidgetFormFilterInput(),
            'mois' => new sfWidgetFormFilterInput(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'libelle' => new sfWidgetFormFilterInput(),
            'paye' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
			
            'periodique' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
			
        ));

        $this->setValidators(array(
            'jour' => new sfValidatorPass(array('required' => false)),
            'mois' => new sfValidatorPass(array('required' => false)),
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'libelle' => new sfValidatorPass(array('required' => false)),
            'paye' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        
		    'periodique' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        
		));

        $this->widgetSchema->setNameFormat('jourferier_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Jourferier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'date' => 'Date',
            'jour' => 'Text',
            'mois' => 'Text',
        );
    }

}
