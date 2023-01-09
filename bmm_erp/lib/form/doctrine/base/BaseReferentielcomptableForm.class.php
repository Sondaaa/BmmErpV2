<?php

/**
 * Referentielcomptable form base class.
 *
 * @method Referentielcomptable getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReferentielcomptableForm extends BaseFormDoctrine {

    public function setup() {
		  $etat = array("0" => "Réferentiel", "1" => "Document Utile");
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'libelle' => new sfWidgetFormInputText(),
           
            'url' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => "<a target='__blanc' href=".sfconfig::get('sf_appdir') . "uploads/images/Referentiel/" . $this->getObject()->getUrl().">".$this->getObject()->getLibelle()."</a><br>",
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => false), array('style' => 'max-width: 500px; max-height: 500px;')),
				
				
            'id_utilisateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'standard'   =>  new sfWidgetFormChoice(array('choices' => $etat)),
            'description'    => new sfWidgetFormTextarea(),
            'id_dossier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
          
            'url' => new sfValidatorFile(array('required' => false, 'path' => 'uploads/images/Referentiel/')),
            'id_utilisateur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
            'standard'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'description'    => new sfValidatorString(array('required' => false)),
            'id_dossier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('referentielcomptable[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Referentielcomptable';
    }

}
