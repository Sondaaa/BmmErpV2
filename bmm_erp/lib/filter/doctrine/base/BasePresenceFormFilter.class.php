<?php

/**
 * Presence filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePresenceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
	   $mois = array("" => "", "01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
    $this->setWidgets(array(
      'id_agents'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'nbrheure'         => new sfWidgetFormFilterInput(),
      'nbhsupp'          => new sfWidgetFormFilterInput(),
      'nbrtotalstandard' => new sfWidgetFormFilterInput(),
      'nbrtotalnormal'   => new sfWidgetFormFilterInput(),
      'ecart'            => new sfWidgetFormFilterInput(),
      
      'semiane'          => new sfWidgetFormFilterInput(),
      'jour'             => new sfWidgetFormFilterInput(),
      'absenceirreg'     => new sfWidgetFormFilterInput(),
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
      'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
      'totalsemain1'     => new sfWidgetFormFilterInput(),
      'totalsemain2'     => new sfWidgetFormFilterInput(),
      'totalsemaine3'    => new sfWidgetFormFilterInput(),
      'totalsemaine4'    => new sfWidgetFormFilterInput(),
      'totalsemaine5'    => new sfWidgetFormFilterInput(),
      'totalheuresupp1'  => new sfWidgetFormFilterInput(),
      'totalheuresupp2'  => new sfWidgetFormFilterInput(),
      'totalheuresupp3'  => new sfWidgetFormFilterInput(),
      'totalheursupp4'   => new sfWidgetFormFilterInput(),
      'totalheuresupp5'  => new sfWidgetFormFilterInput(),
	  'id_regimehoraire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
  ));

    $this->setValidators(array(
      'id_agents'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'nbrheure'         => new sfValidatorPass(array('required' => false)),
      'nbhsupp'          => new sfValidatorPass(array('required' => false)),
      'nbrtotalstandard' => new sfValidatorPass(array('required' => false)),
      'nbrtotalnormal'   => new sfValidatorPass(array('required' => false)),
      'ecart'            => new sfValidatorPass(array('required' => false)),
      'mois'             => new sfValidatorChoice(array('choices' => $mois, 'required' => false)),
      'semiane'          => new sfValidatorPass(array('required' => false)),
      'jour'             => new sfValidatorPass(array('required' => false)),
      'absenceirreg'     => new sfValidatorPass(array('required' => false)),
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'annee'            => new sfValidatorChoice(array('choices' => $annee, 'required' => false)),
      'totalsemain1'     => new sfValidatorPass(array('required' => false)),
      'totalsemain2'     => new sfValidatorPass(array('required' => false)),
      'totalsemaine3'    => new sfValidatorPass(array('required' => false)),
      'totalsemaine4'    => new sfValidatorPass(array('required' => false)),
      'totalsemaine5'    => new sfValidatorPass(array('required' => false)),
      'totalheuresupp1'  => new sfValidatorPass(array('required' => false)),
      'totalheuresupp2'  => new sfValidatorPass(array('required' => false)),
      'totalheuresupp3'  => new sfValidatorPass(array('required' => false)),
      'totalheursupp4'   => new sfValidatorPass(array('required' => false)),
      'totalheuresupp5'  => new sfValidatorPass(array('required' => false)),
	  'id_regimehoraire' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id')),
	
	  
    ));

    $this->widgetSchema->setNameFormat('presence_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Presence';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_agents'        => 'ForeignKey',
      'nbrheure'         => 'Text',
      'nbhsupp'          => 'Text',
      'nbrtotalstandard' => 'Text',
      'nbrtotalnormal'   => 'Text',
      'ecart'            => 'Text',
      'mois'             => 'Text',
      'semiane'          => 'Text',
      'jour'             => 'Text',
      'absenceirreg'     => 'Text',
      'date'             => 'Date',
      'annee'            => 'Text',
      'totalsemain1'     => 'Text',
      'totalsemain2'     => 'Text',
      'totalsemaine3'    => 'Text',
      'totalsemaine4'    => 'Text',
      'totalsemaine5'    => 'Text',
      'totalheuresupp1'  => 'Text',
      'totalheuresupp2'  => 'Text',
      'totalheuresupp3'  => 'Text',
      'totalheursupp4'   => 'Text',
      'totalheuresupp5'  => 'Text',
	 );
  }
}
