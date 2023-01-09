<?php

/**
 * Certificatretenue filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCertificatretenueFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        //Ordonnances de paiements
        $document_budget = Doctrine_Core::getTable('documentbudget')
                ->createQuery('a')
                ->where('id_type=2')
                ->execute();
        $document_budget_choices = array();
        $document_budget_choices[0] = '';
        foreach ($document_budget as $req_db) {
            $document_budget_choices[$req_db->getId()] = $req_db->getNumero();
        }

        $this->setWidgets(array(
            'id_fournisseur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_documentbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
            'objetreglement' => new sfWidgetFormFilterInput(),
            'montantordonnance' => new sfWidgetFormFilterInput(),
            'montantordonnancenet' => new sfWidgetFormFilterInput(),
            'montantht' => new sfWidgetFormFilterInput(),
            'tvadue' => new sfWidgetFormFilterInput(),
            'tvacomprise' => new sfWidgetFormFilterInput(),
            'tvaretenue' => new sfWidgetFormFilterInput(),
            'montantretenue' => new sfWidgetFormFilterInput(),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_retenuesource' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesource'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_fournisseur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'id_documentbudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id')),
            'objetreglement' => new sfValidatorPass(array('required' => false)),
            'montantordonnance' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'montantordonnancenet' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'montantht' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'tvadue' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'tvacomprise' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'tvaretenue' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'montantretenue' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_retenuesource' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Retenuesource'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('certificatretenue_filters[%s]');
        $this->widgetSchema['id_documentbudget'] = new sfWidgetFormChoice(array('choices' => $document_budget_choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Certificatretenue';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_fournisseur' => 'ForeignKey',
            'id_documentbudget' => 'ForeignKey',
            'objetreglement' => 'Text',
            'montantordonnance' => 'Number',
            'montantordonnancenet' => 'Number',
            'montantht' => 'Number',
            'tvadue' => 'Number',
            'tvacomprise' => 'Number',
            'tvaretenue' => 'Number',
            'montantretenue' => 'Number',
            'datecreation' => 'Date',
            'id_retenuesource' => 'ForeignKey',
        );
    }

}
