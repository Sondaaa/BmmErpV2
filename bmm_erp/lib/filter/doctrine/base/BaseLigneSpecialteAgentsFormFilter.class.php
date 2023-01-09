<?php

/**
 * Lignespecialteagents filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignespecialteagentsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'description' => new sfWidgetFormFilterInput(),
            'id_specialite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialite'), 'add_empty' => true)),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'description' => new sfValidatorPass(array('required' => false)),
            'id_specialite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialite'), 'column' => 'id')),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('lignespecialteagents_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Lignespecialteagents';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'nordre' => 'Number',
            'description' => 'Text',
            'id_specialite' => 'ForeignKey',
            'id_agents' => 'ForeignKey',
        );
    }

}
