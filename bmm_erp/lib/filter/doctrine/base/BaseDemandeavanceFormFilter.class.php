<?php

/**
 * Demandeavance filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeavanceFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $mois = array(""=>"","1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
      $annee = array();
      $annee[0]='';
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
            'id_agents' =>  new sfWidgetFormChoice(array('choices' => $choices_agents)),
            'montanttotal' => new sfWidgetFormFilterInput(),
            'montantmensielle' => new sfWidgetFormFilterInput(),
            'id_typeavance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'add_empty' => true)),
            'annee' => new sfWidgetFormChoice(array("choices"=>$annee)),
            'mois' =>new sfWidgetFormChoice(array("choices"=>$mois)),
            'datedebutretenue' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datefinretenue' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
			 'paye'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
        ));

        $this->setValidators(array(
            'id_agents' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'montanttotal' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'montantmensielle' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_typeavance' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avance'), 'column' => 'id')),
            'annee' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'mois' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'datedebutretenue' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefinretenue' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
              'paye'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
		));

        $this->widgetSchema->setNameFormat('demandeavance_filters[%s]');

//         $this->widgetSchema['mois']=new sfWidgetFormChoice(array("choices"=>$mois));
//          $this->widgetSchema['annee']=new sfWidgetFormChoice(array("choices"=>$annee));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandeavance';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'id_agents' => 'ForeignKey',
            'montanttotal' => 'Number',
            'montantmensielle' => 'Number',
            'id_typeavance' => 'ForeignKey',
            'annee' => 'Number',
            'mois' => 'Number',
            'datedebutretenue' => 'Date',
            'datefinretenue' => 'Date',
        );
    }

}
