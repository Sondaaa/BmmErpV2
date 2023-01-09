<?php

/**
 * Historiqueretenue form base class.
 *
 * @method Historiqueretenue getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoriqueretenueForm extends BaseFormDoctrine {

    public function setup() {
        $type = array("" => "", "0" => "Demande Avance", "1" => "Demande Prêt", "2" => "Demande Retenue sur salaire");
        $mois = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $annee = array();
        $annee[0] = '';
        for ($i = 2018; $i <= date('Y'); $i++) {
            $annee +=[$i => $i];
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_retenue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesursalaire'), 'add_empty' => true)),
            'id_demandeavance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeavance'), 'add_empty' => true)),
            'id_demandepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandepret'), 'add_empty' => true)),
            'mois' => new sfWidgetFormChoice(array("choices" => $mois)),
            'annee' => new sfWidgetFormChoice(array("choices" => $annee)),
            'montant' => new sfWidgetFormInputText(),
            'montantrestant' => new sfWidgetFormInputText(),
            'typeextraction' => new sfWidgetFormChoice(array("choices" => $type)),
            'datedemandeextraction' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrmoissoustre' => new sfWidgetFormInputText(),
            'montantsoustre' => new sfWidgetFormInputText(),
		    'montantmensuel'        => new sfWidgetFormInputText(),
           'nbrmoispaye'           => new sfWidgetFormInputText(),
		    'reference'             => new sfWidgetFormInputText(),
      'daterecue'             => new sfWidgetFormInputText(array(), array('type' => 'date')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_retenue' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesursalaire'), 'required' => false)),
            'id_demandeavance' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeavance'), 'required' => false)),
            'id_demandepret' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandepret'), 'required' => false)),
            'mois' => new sfValidatorInteger(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'montant' => new sfValidatorNumber(array('required' => false)),
            'montantrestant' => new sfValidatorNumber(array('required' => false)),
            'typeextraction' => new sfValidatorString(array('max_length' => 55, 'required' => false)),
            'datedemandeextraction' => new sfValidatorDate(array('required' => false)),
            'nbrmoissoustre' => new sfValidatorInteger(array('required' => false)),
            'montantsoustre' => new sfValidatorNumber(array('required' => false)),
			 'montantmensuel'        => new sfValidatorNumber(array('required' => false)),
            'nbrmoispaye'           => new sfValidatorInteger(array('required' => false)),
			 'reference'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'daterecue'             => new sfValidatorDate(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('historiqueretenue[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Historiqueretenue';
    }

}
