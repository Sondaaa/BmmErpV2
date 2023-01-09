<?php

/**
 * Historiqueretenue filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriqueretenueFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $mois = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
        //retenue
        $fournisseurs = Doctrine_Core::getTable('fournisseur')
                ->createQuery('f')
                ->orderBy('f.rs')
                ->execute();
        $choices_fournisseur = array();
        $choices_fournisseur[0] = '';
        foreach ($fournisseurs as $req) {
            $choices_fournisseur[$req->getId()] = $req->getRs();
        }
        
        //avance
        $avances = Doctrine_Core::getTable('avance')
                ->createQuery('a')
                ->orderBy('a.libelle')
                ->execute();
        $choices_avance = array();
        $choices_avance[0] = '';
        foreach ($avances as $req) {
            $choices_avance[$req->getId()] = $req->getLibelle();
        }
        
        //prêt
        $prets = Doctrine_Core::getTable('pret')
                ->createQuery('p')
                ->orderBy('p.libelle')
                ->execute();
        $choices_pret = array();
        $choices_pret[0] = '';
        foreach ($prets as $req) {
            $choices_pret[$req->getId()] =  $req->getLibelle() . ' ' . $req->getSourcepret()->getLibelle();
        }
//agents
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
            'id_retenue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesursalaire'), 'add_empty' => true)),
            'id_demandeavance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeavance'), 'add_empty' => true)),
            'id_demandepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandepret'), 'add_empty' => true)),
            'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
            'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
            'montant' => new sfWidgetFormFilterInput(),
            'montantrestant' => new sfWidgetFormFilterInput(),
            'typeextraction' => new sfWidgetFormFilterInput(),
            'datedemandeextraction' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'nbrmoissoustre' => new sfWidgetFormFilterInput(),
            'montantsoustre' => new sfWidgetFormFilterInput(),
		 	'montantmensuel'        => new sfWidgetFormFilterInput(),
            'nbrmoispaye'           => new sfWidgetFormFilterInput(),
			 'reference'             => new sfWidgetFormFilterInput(),
      'daterecue'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        ));

        $this->setValidators(array(
            'id_retenue' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Retenuesursalaire'), 'column' => 'id')),
            'id_demandeavance' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandeavance'), 'column' => 'id')),
            'id_demandepret' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandepret'), 'column' => 'id')),
            'mois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'annee' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'montant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'montantrestant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'typeextraction' => new sfValidatorPass(array('required' => false)),
            'datedemandeextraction' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nbrmoissoustre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'montantsoustre' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),		
			'montantmensuel'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
			'nbrmoispaye'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
			 'reference'             => new sfValidatorPass(array('required' => false)),
      'daterecue'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
   
        ));

        $this->widgetSchema->setNameFormat('historiqueretenue_filters[%s]');
        $this->widgetSchema['id_retenue'] = new sfWidgetFormChoice(array('choices' => $choices_fournisseur));
        $this->widgetSchema['id_demandeavance'] = new sfWidgetFormChoice(array('choices' => $choices_avance));
        $this->widgetSchema['id_demandepret'] = new sfWidgetFormChoice(array('choices' => $choices_pret));
         $this->widgetSchema['nbrmoissoustre'] = new sfWidgetFormChoice(array('choices' => $choices_agents));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Historiqueretenue';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_retenue' => 'ForeignKey',
            'id_demandeavance' => 'ForeignKey',
            'id_demandepret' => 'ForeignKey',
            'mois' => 'Number',
            'annee' => 'Number',
            'montant' => 'Number',
            'montantrestant' => 'Number',
            'typeextraction' => 'Text',
            'datedemandeextraction' => 'Date',
            'nbrmoissoustre' => 'Number',
            'montantsoustre' => 'Number',
			'montantmensuel'        => 'Number',
			'nbrmoispaye'           => 'Number',
			 'reference'             => 'Text',
      'daterecue'             => 'Date',
        );
    }

}
