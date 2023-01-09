<?php

/**
 * Visitemedicale filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVisitemedicaleFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'destination' => new sfWidgetFormFilterInput(),
            'datedepart' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'dateretour' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrjour' => new sfWidgetFormFilterInput(),
            'motif' => new sfWidgetFormFilterInput(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'duree' => new sfWidgetFormFilterInput(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
			  'id_destination' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatonvisitemedicale'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'destination' => new sfValidatorPass(array('required' => false)),
            'datedepart' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'dateretour' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nbrjour' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'motif' => new sfValidatorPass(array('required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'duree' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
			 'id_destination' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatonvisitemedicale'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('visitemedicale_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Visitemedicale';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'destination' => 'Text',
            'datedepart' => 'Date',
            'dateretour' => 'Date',
            'nbrjour' => 'Number',
            'motif' => 'Text',
            'id_agents' => 'ForeignKey',
            'duree' => 'Number',
            'id_gouvernera' => 'Number',
        );
    }

}
