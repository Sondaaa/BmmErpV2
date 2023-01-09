<?php

/**
 * Evaluation filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEvaluationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'typeformation' => new sfWidgetFormFilterInput(),
            'bureau' => new sfWidgetFormFilterInput(),
            'competance' => new sfWidgetFormFilterInput(),
            'connaissanceaquise' => new sfWidgetFormFilterInput(),
            'conditionslogement' => new sfWidgetFormFilterInput(),
            'notecomposant' => new sfWidgetFormFilterInput(),
            'observation' => new sfWidgetFormFilterInput(),
            'signatureagents' => new sfWidgetFormFilterInput(),
            'cahcetresponsable' => new sfWidgetFormFilterInput(),
            'noteformateur' => new sfWidgetFormFilterInput(),
            'id_formation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'add_empty' => true)),
            'degreobjectif' => new sfWidgetFormInputText(),
            'structureprog' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'typeformation' => new sfValidatorPass(array('required' => false)),
            'bureau' => new sfValidatorPass(array('required' => false)),
            'competance' => new sfValidatorPass(array('required' => false)),
            'connaissanceaquise' => new sfValidatorPass(array('required' => false)),
            'conditionslogement' => new sfValidatorPass(array('required' => false)),
            'notecomposant' => new sfValidatorPass(array('required' => false)),
            'observation' => new sfValidatorPass(array('required' => false)),
            'signatureagents' => new sfValidatorPass(array('required' => false)),
            'cahcetresponsable' => new sfValidatorPass(array('required' => false)),
            'noteformateur' => new sfValidatorPass(array('required' => false)),
            'id_formation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Besoinsdeformation'), 'column' => 'id')),
            'degreobjectif' => new sfValidatorPass(array('required' => false)),
            'structureprog' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('evaluation_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Evaluation';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'competance' => 'Text',
            'connaissanceaquise' => 'Text',
            'conditionslogement' => 'Text',
            'notecomposant' => 'Text',
            'observation' => 'Text',
            'signatureagents' => 'Text',
            'cahcetresponsable' => 'Text',
            'noteformateur' => 'Text',
            'id_formation' => 'ForeignKey',
            'degreobjectif' => 'Text',
            'structureprog' => 'Text',
        );
    }

}
