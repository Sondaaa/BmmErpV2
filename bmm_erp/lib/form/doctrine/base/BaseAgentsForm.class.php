<?php

/**
 * Agents form base class.
 *
 * @method Agents getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAgentsForm extends BaseFormDoctrine {

    public function setup() {
        $array = array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4");

        $etat = array("Non Efféctué" => "Non Efféctué", "Effectué" => "Effectué", "Sous Contrat" => "Sous Contrat", "Disponsé" => "Disponsé");

        $codesociale = Doctrine_Core::getTable('codesociale')->findAll();        
        $choices = array();
        $choices[0] = '';
        foreach ($codesociale as $req) {
            $choices[$req->getId()] = $req->getLibelle();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'nomcomplet' => new sfWidgetFormInputText(),
            'idrh' => new sfWidgetFormInputText(),
            'cin' => new sfWidgetFormInputText(),
            'gsm' => new sfWidgetFormInputText(),
            'mail' => new sfWidgetFormInputText(),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familleagent'), 'add_empty' => true)),
            'prenom' => new sfWidgetFormInputText(),
            'daten' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_gouvn' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'prenompere' => new sfWidgetFormInputText(),
            'prenomgp' => new sfWidgetFormInputText(),
            'nompmere' => new sfWidgetFormInputText(),
            'codepostal' => new sfWidgetFormInputText(),
            'longeur' => new sfWidgetFormInputText(),
            'idpersonnel' => new sfWidgetFormInputText(),
            'cip' => new sfWidgetFormInputText(),
            'dates' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'photo' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/personnel/' . $this->getObject()->getPhoto(),
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
            'accuetiv' => new sfWidgetFormInputText(),
            'id_type_permis' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis'), 'add_empty' => true)),
            'id_niveauxage' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauxage'), 'add_empty' => true)),
            'datenaissance' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'lieunaissance' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'id_niveaueducatif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'add_empty' => true)),
            'id_sexe' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'add_empty' => true)),
            'id_etatcivil' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'add_empty' => true)),
            'adresse' => new sfWidgetFormInputText(),
            'lieun' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'etatmulitaire' => new sfWidgetFormChoice(array('choices' => $etat)),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeagents'), 'add_empty' => true)),
            'id_pays' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
            'idcnss' => new sfWidgetFormInputText(),
            'dateaffiliation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrenfants' => new sfWidgetFormChoice(array('choices' => $array)),
            'rib' => new sfWidgetFormInputText(),
            'cheffamille' => new sfWidgetFormInputCheckbox(),
            'age' => new sfWidgetFormInputText(),
            'regroupement' => new sfWidgetFormInputText(),
            'id_regrouppement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regroupementagents'), 'add_empty' => true)),
            'active' => new sfWidgetFormInputCheckbox(),
            'id_motifabsence' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Motifabsenceinactive'), 'add_empty' => true)),
            'datesortie' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_codesociale' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
            'id_typepermis' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis_14'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nomcomplet' => new sfValidatorString(array('required' => false)),
            'idrh' => new sfValidatorString(array('max_length' => 8, 'required' => false)),
            'cin' => new sfValidatorString(array('max_length' => 8, 'required' => false)),
            'gsm' => new sfValidatorString(array('required' => false)),
            'mail' => new sfValidatorString(array('required' => false)),
            'id_famille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Familleagent'), 'required' => false)),
            'prenom' => new sfValidatorString(array('max_length' => 60, 'required' => false)),
            'daten' => new sfValidatorDate(array('required' => false)),
            'id_gouvn' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'prenompere' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'prenomgp' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'nompmere' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'codepostal' => new sfValidatorInteger(array('required' => false)),
            'longeur' => new sfValidatorNumber(array('required' => false)),
            'idpersonnel' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'cip' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'dates' => new sfValidatorDate(array('required' => false)),
            'photo' => new sfValidatorString(array('required' => false)),
            'accuetiv' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'id_type_permis' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis'), 'required' => false)),
            'id_niveauxage' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauxage'), 'required' => false)),
            'datenaissance' => new sfValidatorDate(array('required' => false)),
            'lieunaissance' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'id_niveaueducatif' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Niveaueducatif'), 'required' => false)),
            'id_sexe' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sexe'), 'required' => false)),
            'id_etatcivil' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etatcivil'), 'required' => false)),
            'adresse' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'etatmulitaire' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeagents'), 'required' => false)),
            'id_pays' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'required' => false)),
            'idcnss' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'lieun' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'dateaffiliation' => new sfValidatorDate(array('required' => false)),
            'nbrenfants' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'rib' => new sfValidatorString(array('required' => false)),
            'cheffamille' => new sfValidatorBoolean(array('required' => false)),
            'age' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'regroupement' => new sfValidatorString(array('max_length' => 35, 'required' => false)),
            'id_regrouppement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regroupementagents'), 'column' => 'id')),
            'active' => new sfValidatorBoolean(array('required' => false)),
            'id_motifabsence' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Motifabsenceinactive'), 'required' => false)),
            'id_codesociale' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'required' => false)),
            'datesortie' => new sfValidatorDate(array('required' => false)),
            'id_typepermis' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typepermis_14'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('agents[%s]');
        $this->widgetSchema['id_codesociale'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Agents';
    }

}
