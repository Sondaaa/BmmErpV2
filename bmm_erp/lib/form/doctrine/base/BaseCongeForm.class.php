<?php

/**
 * Conge form base class.
 *
 * @method Conge getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCongeForm extends BaseFormDoctrine {

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
            'libelle' => new sfWidgetFormInputText(),
            'datedebut' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefin' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrjour' => new sfWidgetFormInputText(),
            'lieu' => new sfWidgetFormInputText(),
            'datedemande' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'lieudedemane' => new sfWidgetFormInputText(),
            'signature' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/personnel/' . $this->getObject()->getSignature(),
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
            'datedebutvalide' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefinvalide' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'datevalide' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'signatureresponsable' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/personnel/' . $this->getObject()->getSignatureresponsable(),
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
            'congeaquise' => new sfWidgetFormInputText(),
            'nbjcongeannuelle' => new sfWidgetFormInputText(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'add_empty' => true)),
            'valide' => new sfWidgetFormInputCheckbox(),
            'objection' => new sfWidgetFormInputCheckbox(),
            'nbrjvalide' => new sfWidgetFormInputText(),
            'responsable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'add_empty' => true)),
            'nbrrestantannepr' => new sfWidgetFormInputText(),
            'nbrcongeralise' => new sfWidgetFormInputText(),
            'nbrcongerestant' => new sfWidgetFormInputText(),
            'daterealise' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefinrealise' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datedenutprologement' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefinprolongement' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'annee' => new sfWidgetFormInputText(),
            'extension' => new sfWidgetFormInputCheckbox(),
            'nbrjourrealise' => new sfWidgetFormInputText(),
            'nbrjourprolonge' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datedebut' => new sfValidatorDate(array('required' => false)),
            'datefin' => new sfValidatorDate(array('required' => false)),
            'nbrjour' => new sfValidatorInteger(array('required' => false)),
            'lieu' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datedemande' => new sfValidatorDate(array('required' => false)),
            'lieudedemane' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'signature' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datedebutvalide' => new sfValidatorDate(array('required' => false)),
            'datefinvalide' => new sfValidatorDate(array('required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'datevalide' => new sfValidatorDate(array('required' => false)),
            'signatureresponsable' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'congeaquise' => new sfValidatorInteger(array('required' => false)),
            'nbjcongeannuelle' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'required' => false)),
            'valide' => new sfValidatorBoolean(array('required' => false)),
            'objection' => new sfValidatorBoolean(array('required' => false)),
            'nbrjvalide' => new sfValidatorInteger(array('required' => false)),
            'responsable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'required' => false)),
            'nbrrestantannepr' => new sfValidatorInteger(array('required' => false)),
            'nbrcongeralise' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'nbrcongerestant' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'daterealise' => new sfValidatorDate(array('required' => false)),
            'datefinrealise' => new sfValidatorDate(array('required' => false)),
            'datedenutprologement' => new sfValidatorDate(array('required' => false)),
            'datefinprolongement' => new sfValidatorDate(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'extension' => new sfValidatorBoolean(array('required' => false)),
            'nbrjourrealise' => new sfValidatorInteger(array('required' => false)),
            'nbrjourprolonge' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('conge[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Conge';
    }

}
