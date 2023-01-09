<?php

/**
 * Paie form base class.
 *
 * @method Paie getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePaieForm extends BaseFormDoctrine {

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
            'id_codesociale' => new sfWidgetFormInputText(),
            'id_contribution' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
            'id_bareme' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Baremeimpot'), 'add_empty' => true)),
            'id_historiqueretenue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Historiqueretenue'), 'add_empty' => true)),
            'mois' => new sfWidgetFormInputText(),
            'annee' => new sfWidgetFormInputText(),
            'assurance' => new sfWidgetFormInputText(),
            'irpp' => new sfWidgetFormInputCheckbox(),
            'cnss' => new sfWidgetFormInputCheckbox(),
            'salairebrut' => new sfWidgetFormInputText(),
            'netsociale' => new sfWidgetFormInputText(),
            'abattement' => new sfWidgetFormInputText(),
            'abattementfraaisprof' => new sfWidgetFormInputText(),
            'abattementenfant' => new sfWidgetFormInputText(),
            'abatementcheffamille' => new sfWidgetFormInputText(),
            'salaireimposable' => new sfWidgetFormInputText(),
            'imposablemensuel' => new sfWidgetFormInputText(),
            'retenueimposable' => new sfWidgetFormInputText(),
            'salairenet' => new sfWidgetFormInputText(),
            'totalacompte' => new sfWidgetFormInputText(),
            'totalretenue' => new sfWidgetFormInputText(),
            'netapayyer' => new sfWidgetFormInputText(),
            'tfp' => new sfWidgetFormInputCheckbox(),
            'foprolos' => new sfWidgetFormInputCheckbox(),
            'id_dossier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
            'id_annepaie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
			   'salairedebase'        => new sfWidgetFormInputText(),
      'contribitionsociale'  => new sfWidgetFormInputText(),
	    'id_contrat'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
		'nbrjtravaille'        => new sfWidgetFormInputText(),
      'nbrjconge'            => new sfWidgetFormInputText(),
      'nbabscenceir'         => new sfWidgetFormInputText(),
     'nbrjf'                => new sfWidgetFormFilterInput(),
	   'id_presence'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'add_empty' => true)),
          'montantsociale'       => new sfWidgetFormInputText(),
		    'salairebrutannuel'    => new sfWidgetFormInputText(),
			  'montantirpp'          => new sfWidgetFormFilterInput(),
			   'montantsocialemensuel' => new sfWidgetFormInputText(),
		    'salaireteorique'       => new sfWidgetFormInputText(),
			 'noterendement'         => new sfWidgetFormInputText(),
      'notepresence'          => new sfWidgetFormInputText(),
      'sbrutderniermois'      => new sfWidgetFormInputText(),
      'basecalculprime'       => new sfWidgetFormInputText(),
      'brutprime'             => new sfWidgetFormInputText(),
	    'id_lignecodesociale'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'add_empty' => true)),
		));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'id_codesociale' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'required' => false)),
            'id_contribution' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'required' => false)),
            'id_bareme' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Baremeimpot'), 'required' => false)),
            'id_historiqueretenue' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Historiqueretenue'), 'required' => false)),
            'mois' => new sfValidatorInteger(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'assurance' => new sfValidatorNumber(array('required' => false)),
            'irpp' => new sfValidatorBoolean(array('required' => false)),
            'cnss' => new sfValidatorBoolean(array('required' => false)),
            'salairebrut' => new sfValidatorNumber(array('required' => false)),
            'netsociale' => new sfValidatorNumber(array('required' => false)),
            'abattement' => new sfValidatorNumber(array('required' => false)),
            'abattementfraaisprof' => new sfValidatorNumber(array('required' => false)),
            'abattementenfant' => new sfValidatorNumber(array('required' => false)),
            'abatementcheffamille' => new sfValidatorNumber(array('required' => false)),
            'salaireimposable' => new sfValidatorNumber(array('required' => false)),
            'imposablemensuel' => new sfValidatorNumber(array('required' => false)),
            'retenueimposable' => new sfValidatorNumber(array('required' => false)),
            'salairenet' => new sfValidatorNumber(array('required' => false)),
            'totalacompte' => new sfValidatorNumber(array('required' => false)),
            'totalretenue' => new sfValidatorNumber(array('required' => false)),
            'netapayyer' => new sfValidatorNumber(array('required' => false)),
            'tfp' => new sfValidatorBoolean(array('required' => false)),
            'foprolos' => new sfValidatorBoolean(array('required' => false)),
            'id_dossier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'required' => false)),
            'id_annepaie' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'required' => false)),
			    'salairedebase'        => new sfValidatorNumber(array('required' => false)),
      'contribitionsociale'  => new sfValidatorNumber(array('required' => false)),
	    'id_contrat'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
		  'nbrjtravaille'        => new sfValidatorInteger(array('required' => false)),
      'nbrjconge'            => new sfValidatorInteger(array('required' => false)),
      'nbabscenceir'         => new sfValidatorInteger(array('required' => false)),
	   'nbrjf'                => new sfValidatorInteger(array('required' => false)),
	      'id_presence'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'required' => false)),
  
   'montantsociale'       => new sfValidatorNumber(array('required' => false)),     
      'salairebrutannuel'    => new sfValidatorNumber(array('required' => false)),
	   'montantirpp'          => new sfValidatorNumber(array('required' => false)),
	      'montantsocialemensuel' => new sfValidatorNumber(array('required' => false)),
 'salaireteorique'       => new sfValidatorNumber(array('required' => false)),	
  'id_lignecodesociale'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'required' => false)),
	));

        $this->widgetSchema->setNameFormat('paie[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Paie';
    }

}
