<?php

/**
 * Lignelangueagents filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignelangueagentsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'description' => new sfWidgetFormFilterInput(),
            'id_langue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Langues'), 'add_empty' => true)),
            'id_angents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'description' => new sfValidatorPass(array('required' => false)),
            'id_langue' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Langues'), 'column' => 'id')),
            'id_angents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('lignelangueagents_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Lignelangueagents';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'description' => 'Text',
            'nordre' => 'Number',
            'id_langue' => 'ForeignKey',
            'id_angents' => 'ForeignKey',
        );
    }

}
