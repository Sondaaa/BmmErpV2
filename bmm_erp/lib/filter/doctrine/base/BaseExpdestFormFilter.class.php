<?php

/**
 * Expdest filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExpdestFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'maxdate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'npresponsable' => new sfWidgetFormFilterInput(),
            'rs' => new sfWidgetFormFilterInput(),
            'matricule' => new sfWidgetFormFilterInput(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typexpdes'), 'add_empty' => true)),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'tel' => new sfWidgetFormFilterInput(),
            'gsm' => new sfWidgetFormFilterInput(),
            'email' => new sfWidgetFormFilterInput(),
            'fax' => new sfWidgetFormFilterInput(),
            'adr' => new sfWidgetFormFilterInput(),
            'codepostal' => new sfWidgetFormFilterInput(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'maxdate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'npresponsable' => new sfValidatorPass(array('required' => false)),
            'rs' => new sfValidatorPass(array('required' => false)),
            'matricule' => new sfValidatorPass(array('required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typexpdes'), 'column' => 'id')),
            'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id')),
            'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'tel' => new sfValidatorPass(array('required' => false)),
            'gsm' => new sfValidatorPass(array('required' => false)),
            'email' => new sfValidatorPass(array('required' => false)),
            'fax' => new sfValidatorPass(array('required' => false)),
            'adr' => new sfValidatorPass(array('required' => false)),
            'codepostal' => new sfValidatorPass(array('required' => false)),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
            'id_frs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('expdest_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Expdest';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'datecreation' => 'Date',
            'maxdate' => 'Date',
            'npresponsable' => 'Text',
            'rs' => 'Text',
            'matricule' => 'Text',
            'id_type' => 'ForeignKey',
            'id_famille' => 'ForeignKey',
            'id_agent' => 'ForeignKey',
        );
    }

}
