<?php

/**
 * Mouvementbanciare filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMouvementbanciareFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $caissesbanques = Doctrine_Core::getTable('caissesbanques')
                ->createQuery('a')
                ->where('id_typecb=2')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($caissesbanques as $req) {
            $choices[$req->getId()] = $req->getLibelle();
        }
        $this->setWidgets(array(
            'reford' => new sfWidgetFormFilterInput(),
            'id_object' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'add_empty' => true)),
            'refbenifi' => new sfWidgetFormFilterInput(),
            'id_banque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'id_instrument' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Instrumentpaiment'), 'add_empty' => true)),
            'id_cheque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Papiercheque'), 'add_empty' => true)),
            'debit' => new sfWidgetFormFilterInput(),
            'credit' => new sfWidgetFormFilterInput(),
            'solde' => new sfWidgetFormFilterInput(),
            'mntenoper' => new sfWidgetFormFilterInput(),
            'ribbeni' => new sfWidgetFormFilterInput(),
            'dateoperation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
            'nomoperation' => new sfWidgetFormFilterInput(),
            'referenceautre' => new sfWidgetFormFilterInput(),
            'numero' => new sfWidgetFormFilterInput(),
            'id_bordereauvirement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bordereauvirement'), 'add_empty' => true)),
            'id_documentbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
            'id_mouvement' => new sfWidgetFormFilterInput(),
            'rapproche' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'rapprochecommission' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'annule' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
          'id_budget'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
    ));

        $this->setValidators(array(
            'reford' => new sfValidatorPass(array('required' => false)),
            'id_object' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Objetreglement'), 'column' => 'id')),
            'refbenifi' => new sfValidatorPass(array('required' => false)),
            'id_banque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'id_instrument' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Instrumentpaiment'), 'column' => 'id')),
            'id_cheque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Papiercheque'), 'column' => 'id')),
            'debit' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'credit' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'solde' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mntenoper' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'ribbeni' => new sfValidatorPass(array('required' => false)),
            'dateoperation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeoperation'), 'column' => 'id')),
            'nomoperation' => new sfValidatorPass(array('required' => false)),
            'referenceautre' => new sfValidatorPass(array('required' => false)),
            'numero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'id_bordereauvirement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bordereauvirement'), 'column' => 'id')),
            'id_documentbudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id')),
            'id_mouvement' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'rapproche' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'rapprochecommission' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'annule' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'id_documentachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
     'id_budget'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('mouvementbanciare_filters[%s]');
        $this->widgetSchema['id_banque'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Mouvementbanciare';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'reford' => 'Text',
            'id_object' => 'ForeignKey',
            'refbenifi' => 'Text',
            'id_banque' => 'ForeignKey',
            'id_instrument' => 'ForeignKey',
            'id_cheque' => 'ForeignKey',
            'debit' => 'Number',
            'credit' => 'Number',
            'solde' => 'Number',
            'mntenoper' => 'Number',
            'ribbeni' => 'Text',
            'dateoperation' => 'Date',
            'id_type' => 'ForeignKey',
            'nomoperation' => 'Text',
            'numero' => 'Number',
            'id_bordereauvirement' => 'ForeignKey',
            'id_documentbudget' => 'ForeignKey',
            'id_mouvement' => 'Number',
            'rapproche' => 'Boolean',
            'rapprochecommission' => 'Boolean',
            'annule' => 'Boolean',
            'id_documentachat' => 'ForeignKey',
        );
    }

}
