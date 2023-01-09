<?php

/**
 * Documentod form base class.
 *
 * @method Documentod getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentodForm extends BaseFormDoctrine {

    public function setup() {

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'numero' => new sfWidgetFormInputText(),
            'reference' => new sfWidgetFormInputText(),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'observation' => new sfWidgetFormTextarea(),
            'chemindoc' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Photo",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/images/' . $this->getObject()->getChemindoc(),
                // à vrai
                'is_image' => true)),
            'id_demandeur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
            'id_typedoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
            'id_adresse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
            'id_lignedirectionsite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
            'desiegniation' => new sfWidgetFormInputText(),
            'id_objet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objectdocument'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'mht' => new sfWidgetFormInputText(),
            'mnttva' => new sfWidgetFormInputText(),
            'mntttc' => new sfWidgetFormInputText(),
            'etatdocachat' => new sfWidgetFormInputText(),
            'id_etatdoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'delaifrs' => new sfWidgetFormInputText(),
            'maxreponsefrs' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datesignature' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'mnthtax' => new sfWidgetFormInputText(),
                    ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'numero' => new sfValidatorInteger(array('required' => false)),
            'reference' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
            'datecreation' => new sfValidatorDate(array('required' => false)),
            'observation' => new sfValidatorString(array('required' => false)),
            'chemindoc' => new sfValidatorFile(array('required' => false, 'path' => 'uploads/images/', 'mime_types' => 'web_images')),
            'id_demandeur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'required' => false)),
            'id_typedoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'required' => false)),
            'id_adresse' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'required' => false)),
            'id_lignedirectionsite' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'required' => false)),
            'desiegniation' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
            'id_objet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Objectdocument'), 'required' => false)),
            'id_projet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
            'mht' => new sfValidatorNumber(array('required' => false)),
            'mnttva' => new sfValidatorNumber(array('required' => false)),
            'mntttc' => new sfValidatorNumber(array('required' => false)),
            'etatdocachat' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
            'id_etatdoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'required' => false)),
            'id_frs' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
            'id_user' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
            'delaifrs' => new sfValidatorInteger(array('required' => false)),
            'maxreponsefrs' => new sfValidatorDate(array('required' => false)),
            'datesignature' => new sfValidatorDate(array('required' => false)),
            'mnthtax' => new sfValidatorNumber(array('required' => false)),
                  ));

        $this->widgetSchema->setNameFormat('documentachat[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Documentod';
    }

}
