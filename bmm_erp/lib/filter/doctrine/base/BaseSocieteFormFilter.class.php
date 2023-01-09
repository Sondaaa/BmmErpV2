<?php

/**
 * Societe filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSocieteFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'rs' => new sfWidgetFormFilterInput(),
            'matfiscal' => new sfWidgetFormFilterInput(),
            'logo' => new sfWidgetFormFilterInput(),
            'observation' => new sfWidgetFormFilterInput(),
            'codepostal' => new sfWidgetFormFilterInput(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'tel' => new sfWidgetFormFilterInput(),
            'gsm' => new sfWidgetFormFilterInput(),
            'fax' => new sfWidgetFormFilterInput(),
            'id_pays' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
            'adresse' => new sfWidgetFormFilterInput(),
            'mail' => new sfWidgetFormFilterInput(),
            'activite' => new sfWidgetFormFilterInput(),
            'idunique' => new sfWidgetFormFilterInput(),
            'typecotisation' => new sfWidgetFormFilterInput(),
			 'nbremoisannuel' => new sfWidgetFormFilterInput(),
			 'br'             => new sfWidgetFormFilterInput(),
			 'annee'          => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'rs' => new sfValidatorPass(array('required' => false)),
            'matfiscal' => new sfValidatorPass(array('required' => false)),
            'logo' => new sfValidatorPass(array('required' => false)),
            'observation' => new sfValidatorPass(array('required' => false)),
            'codepostal' => new sfValidatorPass(array('required' => false)),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
            'tel' => new sfValidatorPass(array('required' => false)),
            'gsm' => new sfValidatorPass(array('required' => false)),
            'fax' => new sfValidatorPass(array('required' => false)),
            'id_pays' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
            'adresse' => new sfValidatorPass(array('required' => false)),
            'mail' => new sfValidatorPass(array('required' => false)),
            'activite' => new sfValidatorPass(array('required' => false)),
            'idunique' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'typecotisation' => new sfValidatorPass(array('required' => false)),
			 'nbremoisannuel' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
			   'br'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
			   'annee'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('societe_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Societe';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'rs' => 'Text',
            'matfiscal' => 'Text',
            'logo' => 'Text',
            'observation' => 'Text',
            'timbre' => 'Number',
            'codepostal' => 'Text',
            'id_gouvernera' => 'ForeignKey',
            'tel' => 'Text',
            'gsm' => 'Text',
            'fax' => 'Text',
            'id_pays' => 'ForeignKey',
            'adresse' => 'Text',
            'mail' => 'Text',
            'activite' => 'Text',
            'idunique' => 'Number',
            'typecotisation' => 'Text',
			  'br'             => 'Number',
        );
    }

}
