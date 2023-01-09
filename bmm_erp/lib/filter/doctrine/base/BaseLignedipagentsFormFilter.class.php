<?php

/**
 * Lignedipagents filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignedipagentsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'annee' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_diplome' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Diplome'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'annee' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_diplome' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Diplome'), 'column' => 'id')),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('lignedipagents_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Lignedipagents';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'libelle' => 'Text',
            'annee' => 'Date',
            'nordre' => 'Number',
            'id_agents' => 'ForeignKey',
            'id_diplome' => 'ForeignKey',
        );
    }

}
