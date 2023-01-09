<?php

/**
 * Conjoints filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConjointsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'nom' => new sfWidgetFormFilterInput(),
            'prenom' => new sfWidgetFormFilterInput(),
            'etattravail' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'nom' => new sfValidatorPass(array('required' => false)),
            'prenom' => new sfValidatorPass(array('required' => false)),
            'etattravail' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('conjoints_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Conjoints';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'nordre' => 'Number',
            'nom' => 'Text',
            'prenom' => 'Text',
            'etattravail' => 'Boolean',
            'id_agents' => 'ForeignKey',
        );
    }

}
