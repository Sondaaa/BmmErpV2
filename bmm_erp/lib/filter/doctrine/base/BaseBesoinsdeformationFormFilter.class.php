<?php

/**
 * Besoinsdeformation filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBesoinsdeformationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'besoins' => new sfWidgetFormFilterInput(),
            'competance' => new sfWidgetFormFilterInput(),
            'annee' => new sfWidgetFormFilterInput(),
            'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
            'id_poste' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
            'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'besoins' => new sfValidatorPass(array('required' => false)),
            'competance' => new sfValidatorPass(array('required' => false)),
            'annee' => new sfValidatorPass(array('required' => false)),
            'id_contrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
            'id_poste' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'required' => false)),
            'id_unite' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('besoinsdeformation_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Besoinsdeformation';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'besoins' => 'Text',
            'annee' => 'Text',
            'competance' => 'Text',
            'id_contrat' => 'ForeignKey',
        );
    }

}
