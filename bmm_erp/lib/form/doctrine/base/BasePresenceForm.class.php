<?php

/**
 * Presence form base class.
 *
 * @method Presence getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePresenceForm extends BaseFormDoctrine {

    public function setup() {
        $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->where('a.id_motifabsence IS NULL ')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($agents as $req) {
            $choices[$req->getId()] = $req->getIdrh() . " " . $req->getNomcomplet() . " " . $req->getPrenom();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'nbrheure' => new sfWidgetFormInputText(),
            'nbhsupp' => new sfWidgetFormInputText(),
            'nbrtotalstandard' => new sfWidgetFormInputText(),
            'nbrtotalnormal' => new sfWidgetFormInputText(),
            'ecart' => new sfWidgetFormInputText(),
            'mois' => new sfWidgetFormInputText(),
            'semiane' => new sfWidgetFormInputText(),
            'jour' => new sfWidgetFormInputText(),
            'absenceirreg' => new sfWidgetFormInputText(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'annee' => new sfWidgetFormInputText(),
            'totalsemain1' => new sfWidgetFormInputText(),
            'totalsemain2' => new sfWidgetFormInputText(),
            'totalsemaine3' => new sfWidgetFormInputText(),
            'totalsemaine4' => new sfWidgetFormInputText(),
            'totalsemaine5' => new sfWidgetFormInputText(),
            'totalheuresupp1' => new sfWidgetFormInputText(),
            'totalheuresupp2' => new sfWidgetFormInputText(),
            'totalheuresupp3' => new sfWidgetFormInputText(),
            'totalheursupp4' => new sfWidgetFormInputText(),
            'totalheuresupp5' => new sfWidgetFormInputText(),
			'id_regimehoraire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'nbrheure' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'nbhsupp' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'nbrtotalstandard' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'nbrtotalnormal' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'ecart' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'mois' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'semiane' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'jour' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'absenceirreg' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'annee' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'totalsemain1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalsemain2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalsemaine3' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalsemaine4' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalsemaine5' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalheuresupp1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalheuresupp2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalheuresupp3' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalheursupp4' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'totalheuresupp5' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
		    'id_regimehoraire' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('presence[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Presence';
    }

}
