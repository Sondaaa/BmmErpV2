<?php

/**
 * Experiences filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExperiencesFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'description' => new sfWidgetFormFilterInput(),
            'organistaion' => new sfWidgetFormFilterInput(),
            'duree' => new sfWidgetFormFilterInput(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_typeexperience' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeexperience'), 'add_empty' => true)),
            'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'description' => new sfValidatorPass(array('required' => false)),
            'organistaion' => new sfValidatorPass(array('required' => false)),
            'duree' => new sfValidatorPass(array('required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_typeexperience' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeexperience'), 'column' => 'id')),
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('experiences_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Experiences';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'description' => 'Text',
            'nordre' => 'Number',
            'organistaion' => 'Text',
            'duree' => 'Number',
            'id_agents' => 'ForeignKey',
            'id_typeexperience' => 'ForeignKey',
            'date' => 'Date',
        );
    }

}
