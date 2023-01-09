<?php

/**
 * Retenuesursalaire filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRetenuesursalaireFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
         $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->from('Agents a')
                ->leftJoin('a.Contrat c')
                ->where('a.id_regrouppement=1')
                ->andWhere('c.id_typecontrat=1')
                ->orderBy('a.nomcomplet')
                ->execute();
        $choices_agents = array();
        $choices_agents[0] = '';
        foreach ($agents as $req) {
            $choices_agents[$req->getId()] = $req->getIdrh() . ' ' . $req->getNomcomplet() . ' ' . $req->getPrenom();
        }
        $mois = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
		  $typepret = array("" => "", "0" => "Fournisseur", "1" => "Prêt Amicale");
        $this->setWidgets(array(
            'id_fournisseur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'naturepret' =>  new sfWidgetFormChoice(array("choices" => $typepret)),
            'montantpret' => new sfWidgetFormFilterInput(),
            'retenuesursalaire' => new sfWidgetFormFilterInput(),
            'nbrmois' => new sfWidgetFormFilterInput(),
            'datedebut' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefin' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_agents' =>new sfWidgetFormChoice(array('choices' => $choices_agents)),
            'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
            'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
            'datedemande' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
	   'paye'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
	   'salairenetapayer'     => new sfWidgetFormFilterInput(),
      'valide'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pourcentagedesalaire' => new sfWidgetFormFilterInput(),
      'montantdupourcentage' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'id_fournisseur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'naturepret' => new sfValidatorPass(array('required' => false)),
            'montantpret' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'retenuesursalaire' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'nbrmois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'datedebut' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefin' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'mois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'annee' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'datedemande' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
         'paye'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
		  'salairenetapayer'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'valide'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pourcentagedesalaire' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantdupourcentage' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   ));

        $this->widgetSchema->setNameFormat('retenuesursalaire_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Retenuesursalaire';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_fournisseur' => 'ForeignKey',
            'naturepret' => 'Text',
            'montantpret' => 'Number',
            'retenuesursalaire' => 'Number',
            'nbrmois' => 'Number',
            'datedebut' => 'Date',
            'datefin' => 'Date',
            'id_agents' => 'ForeignKey',
            'datedemande' => 'Date',
        );
    }

}
