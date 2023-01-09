<?php

/**
 * Retenuesursalaire form base class.
 *
 * @method Retenuesursalaire getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRetenuesursalaireForm extends BaseFormDoctrine {

    public function setup() {
        $typepret = array("" => "", "0" => "Fournisseur", "1" => "Prêt Amicale");
        $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->from('Agents a')
                ->leftJoin('a.Contrat c')
                ->where('a.id_regrouppement=1')
                ->andWhere('a.id_motifabsence IS NULL')
                ->andWhere('c.id_typecontrat=1')
                ->orderBy('a.nomcomplet')
                ->execute();
        $choices_agents = array();
        $choices_agents[0] = '';
        foreach ($agents as $req) {
            $choices_agents[$req->getId()] = $req->getIdrh() . ' ' . $req->getNomcomplet() . ' ' . $req->getPrenom();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_fournisseur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'naturepret' => new sfWidgetFormChoice(array("choices" => $typepret)),
            'montantpret' => new sfWidgetFormInputText(),
            'retenuesursalaire' => new sfWidgetFormInputText(),
            'nbrmois' => new sfWidgetFormInputText(),
            'datedebut' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefin' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_agents' => new sfWidgetFormChoice(array('choices' => $choices_agents)),
            'mois' => new sfWidgetFormInputText(),
            'annee' => new sfWidgetFormInputText(),
            'datedemande' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'paye' => new sfWidgetFormInputCheckbox(),
            'salairenetapayer' => new sfWidgetFormInputText(),
            'valide' => new sfWidgetFormInputCheckbox(),
            'pourcentagedesalaire' => new sfWidgetFormInputText(),
            'montantdupourcentage' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_fournisseur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
            'naturepret' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
            'montantpret' => new sfValidatorNumber(array('required' => false)),
            'retenuesursalaire' => new sfValidatorNumber(array('required' => false)),
            'nbrmois' => new sfValidatorInteger(array('required' => false)),
            'datedebut' => new sfValidatorDate(array('required' => false)),
            'datefin' => new sfValidatorDate(array('required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'mois' => new sfValidatorInteger(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'datedemande' => new sfValidatorDate(array('required' => false)),
            'paye' => new sfValidatorBoolean(array('required' => false)),
            'salairenetapayer' => new sfValidatorNumber(array('required' => false)),
            'valide' => new sfValidatorBoolean(array('required' => false)),
            'pourcentagedesalaire' => new sfValidatorInteger(array('required' => false)),
            'montantdupourcentage' => new sfValidatorNumber(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('retenuesursalaire[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Retenuesursalaire';
    }

}
