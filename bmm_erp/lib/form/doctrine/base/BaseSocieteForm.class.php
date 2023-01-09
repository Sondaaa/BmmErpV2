<?php

/**
 * Societe form base class.
 *
 * @method Societe getObject() Returns the current form's model object
 *
 * @package    Commercial
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSocieteForm extends BaseFormDoctrine {

    public function setup() {
        $type = array("" => "", "1" => "CNSS", "2" => "CNRPS");
        $mois = array("" => "", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18");

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'rs' => new sfWidgetFormInputText(),
            'ministere' => new sfWidgetFormInputText(),
            'matfiscal' => new sfWidgetFormInputText(),
            'logo' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Photo",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/images/' . $this->getObject()->getLogo(),
                // à vrai
                'is_image' => true)),
            'observation' => new sfWidgetFormTextarea(),
            'codepostal' => new sfWidgetFormInputText(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'tel' => new sfWidgetFormInputText(),
            'telephone' => new sfWidgetFormInputText(),
            'gsm' => new sfWidgetFormInputText(),
            'fax' => new sfWidgetFormInputText(),
            'id_pays' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
            'adresse' => new sfWidgetFormTextarea(),
            'mail' => new sfWidgetFormInputText(),
            'activite' => new sfWidgetFormInputText(),
            'idunique' => new sfWidgetFormInputText(),
            'typecotisation' => new sfWidgetFormChoice(array('choices' => $type)),
            'nbremoisannuel' => new sfWidgetFormChoice(array('choices' => $mois)),
            'br' => new sfWidgetFormInputText(),
            'annee' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'rs' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'ministere' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'matfiscal' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'logo' => new sfValidatorFile(array('required' => false, 'path' => 'uploads/images/', 'mime_types' => 'web_images')),
            'observation' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'codepostal' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'tel' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'telephone' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'gsm' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'fax' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'id_pays' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'required' => false)),
            'adresse' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'mail' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'activite' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'idunique' => new sfValidatorInteger(array('required' => false)),
            'typecotisation' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'nbremoisannuel' => new sfValidatorInteger(array('required' => false)),
            'br' => new sfValidatorInteger(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('societe[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Societe';
    }

}
