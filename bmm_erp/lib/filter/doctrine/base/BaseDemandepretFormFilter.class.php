<?php

/**
 * Demandepret filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandepretFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $mois = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
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
        $this->setWidgets(array(
            'id_agents' => new sfWidgetFormChoice(array('choices' => $choices_agents)),
            'montantpret' => new sfWidgetFormFilterInput(),
            'datedemande' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'lieu' => new sfWidgetFormFilterInput(),
            'situationmulitaire' => new sfWidgetFormFilterInput(),
            'salairebrut' => new sfWidgetFormFilterInput(),
            'id_typepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'add_empty' => true)),
            'datedebutretenue' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datefinretenue' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'nbrmois' => new sfWidgetFormFilterInput(),
            'montantmentielle' => new sfWidgetFormFilterInput(),
            'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
            'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
            'id_sourcepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'add_empty' => true)),
            'societe' => new sfWidgetFormFilterInput(),
            'numerodecnss' => new sfWidgetFormFilterInput(),
            'paye' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'valide' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'signature' => new sfWidgetFormFilterInput(),
			  'id_validateur'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_5'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'montantpret' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'datedemande' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'lieu' => new sfValidatorPass(array('required' => false)),
            'situationmulitaire' => new sfValidatorPass(array('required' => false)),
            'salairebrut' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_typepret' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pret'), 'column' => 'id')),
            'datedebutretenue' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefinretenue' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nbrmois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'montantmentielle' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'annee' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'id_sourcepret' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sourcepret'), 'column' => 'id')),
            'societe' => new sfValidatorPass(array('required' => false)),
            'numerodecnss' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'paye' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'valide' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'signature' => new sfValidatorPass(array('required' => false)),
			'id_validateur'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents_5'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('demandepret_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandepret';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'montantpret' => 'Number',
            'datedemande' => 'Date',
            'lieu' => 'Text',
            'situationmulitaire' => 'Text',
            'salairebrut' => 'Number',
            'id_typepret' => 'ForeignKey',
            'datedebutretenue' => 'Date',
            'datefinretenue' => 'Date',
            'nbrmois' => 'Number',
            'montantmentielle' => 'Number',
            'mois' => 'Number',
            'annee' => 'Number',
            'id_sourcepret' => 'ForeignKey',
            'societe' => 'Text',
            'numerodecnss' => 'Number',
        );
    }

}
