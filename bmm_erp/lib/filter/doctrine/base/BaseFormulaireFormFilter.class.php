<?php

/**
 * Formulaire filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFormulaireFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id_agents' =>new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
             'note2' => new sfWidgetFormFilterInput(),
            'note3' => new sfWidgetFormFilterInput(),
            'note1' => new sfWidgetFormFilterInput(),
            'total' => new sfWidgetFormFilterInput(),
            'mayen' => new sfWidgetFormFilterInput(),
            'dureemois' => new sfWidgetFormFilterInput(),
            'dureejou' => new sfWidgetFormFilterInput(),
            'nbpointmois' => new sfWidgetFormFilterInput(),
            'nbrponitsjour' => new sfWidgetFormFilterInput(),
            'totalpoint' => new sfWidgetFormFilterInput(),
            'nbrpointsancien' => new sfWidgetFormFilterInput(),
            'nbrpointjouranci' => new sfWidgetFormFilterInput(),
            'totalponitanci' => new sfWidgetFormFilterInput(),
            'etat' => new sfWidgetFormFilterInput(),
            
            'ancienete' => new sfWidgetFormFilterInput(),
			 'cheminsignature'   => new sfWidgetFormFilterInput(), 
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'id_contrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
            'note2' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'note3' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'note1' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'total' => new sfValidatorPass(array('required' => false)),
            'mayen' => new sfValidatorPass(array('required' => false)),
            'dureemois' => new sfValidatorPass(array('required' => false)),
            'dureejou' => new sfValidatorPass(array('required' => false)),
            'nbpointmois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'nbrponitsjour' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'totalpoint' => new sfValidatorPass(array('required' => false)),
            'nbrpointsancien' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'nbrpointjouranci' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'totalponitanci' => new sfValidatorPass(array('required' => false)),
            'etat' => new sfValidatorPass(array('required' => false)),
    
             'ancienete' => new sfValidatorPass(array('required' => false)),
			  'cheminsignature'   => new sfValidatorPass(array('required' => false)),
 ));

        $this->widgetSchema->setNameFormat('formulaire_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Formulaire';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'id_contrat' => 'ForeignKey',
            
            'note2' => 'Number',
            'note3' => 'Number',
            'note1' => 'Number',
            'total' => 'Text',
            'mayen' => 'Text',
            'dureemois' => 'Text',
            'dureejou' => 'Text',
            'nbpointmois' => 'Number',
            'nbrponitsjour' => 'Number',
            'totalpoint' => 'Text',
            'nbrpointsancien' => 'Number',
            'nbrpointjouranci' => 'Number',
            'totalponitanci' => 'Text',
        );
    }

}
