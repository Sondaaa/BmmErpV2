<?php

/**
 * Mouvementbanciare form base class.
 *
 * @method Mouvementbanciare getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMouvementbanciareForm extends BaseFormDoctrine {

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
        //Ordonnances de paiements
        $document_budget = Doctrine_Core::getTable('documentbudget')
                ->createQuery('a')
                ->where('id_type=2')
                ->andWhere('id_documentbudget IS NULL')
                ->execute();
        $document_budget_choices = array();
        $document_budget_choices[0] = '';
        foreach ($document_budget as $req_db) {
            $document_budget_choices[$req_db->getId()] = $req_db->getNumero();
        }

        //Bon de dépenses au comptant
        $ligneOperationCaisse = new Ligneoperationcaisse();
        $listesBDCP_NonValiderParCaisseOuBanque = $ligneOperationCaisse->getArrayDocumentsachats();
        if ($listesBDCP_NonValiderParCaisseOuBanque != null)
            $document_achat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=2 or id_typedoc=15')
                    ->andWhereNotIn('id', $listesBDCP_NonValiderParCaisseOuBanque)
                    ->execute();
        else
            $document_achat = null;
        $document_achat_choices = array();
        $document_achat_choices[0] = '';
        foreach ($document_achat as $req_db) {
            $document_achat_choices[$req_db->getId()] = $req_db->getNumero();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'reford' => new sfWidgetFormInputText(),
            'id_object' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'add_empty' => true)),
            'refbenifi' => new sfWidgetFormInputText(),
            'id_banque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'id_instrument' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Instrumentpaiment'), 'add_empty' => true)),
            'id_cheque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Papiercheque'), 'add_empty' => true)),
            'debit' => new sfWidgetFormInputText(),
            'credit' => new sfWidgetFormInputText(),
            'solde' => new sfWidgetFormInputText(),
            'mntenoper' => new sfWidgetFormInputText(),
            'ribbeni' => new sfWidgetFormInputText(),
            'referenceautre' => new sfWidgetFormInputText(),
            'dateoperation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
            'nomoperation' => new sfWidgetFormInputText(),
            'numero' => new sfWidgetFormInputText(),
            'id_bordereauvirement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bordereauvirement'), 'add_empty' => true)),
            'id_documentbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
            'id_mouvement' => new sfWidgetFormInputText(),
            'rapproche' => new sfWidgetFormInputCheckbox(),
            'rapprochecommission' => new sfWidgetFormInputCheckbox(),
            'annule' => new sfWidgetFormInputCheckbox(),
            'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
         'id_budget'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
     ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'reford' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'id_object' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'required' => false)),
            'refbenifi' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'id_banque' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'required' => false)),
            'id_instrument' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Instrumentpaiment'), 'required' => false)),
            'id_cheque' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Papiercheque'), 'required' => false)),
            'debit' => new sfValidatorNumber(array('required' => false)),
            'credit' => new sfValidatorNumber(array('required' => false)),
            'solde' => new sfValidatorNumber(array('required' => false)),
            'mntenoper' => new sfValidatorNumber(array('required' => false)),
            'ribbeni' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'dateoperation' => new sfValidatorDate(array('required' => false)),
            'referenceautre' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'required' => false)),
            'nomoperation' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
            'numero' => new sfValidatorInteger(array('required' => false)),
            'id_bordereauvirement' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bordereauvirement'), 'required' => false)),
            'id_documentbudget' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'required' => false)),
            'id_mouvement' => new sfValidatorInteger(array('required' => false)),
            'rapproche' => new sfValidatorBoolean(array('required' => false)),
            'rapprochecommission' => new sfValidatorBoolean(array('required' => false)),
            'annule' => new sfValidatorBoolean(array('required' => false)),
            'id_documentachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
          'id_budget'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
   ));

        $this->widgetSchema->setNameFormat('mouvementbanciare[%s]');
        $this->widgetSchema['id_banque'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->widgetSchema['id_documentbudget'] = new sfWidgetFormChoice(array('choices' => $document_budget_choices));
        $this->widgetSchema['id_documentachat'] = new sfWidgetFormChoice(array('choices' => $document_achat_choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Mouvementbanciare';
    }

}
