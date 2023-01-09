<?php

/**
 * Piecejoint form base class.
 *
 * @method Piecejoint getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePiecejointForm extends BaseFormDoctrine {

    public function setup() {
//        $defaut="";
//        $class="";
//         if (isset($_REQUEST['idcourrier'])) {
//            $defaut=$_REQUEST['idcourrier'];
//            $class="disabledbutton";
//        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'objet' => new sfWidgetFormInputText(),
            'id_typepiece' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiece'), 'add_empty' => true)),
            'id_courrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'), 'add_empty' => true)),
            // 'id_parcour' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parcourcourier'), 'add_empty' => true)),
            'chemin' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/scanner/' . $this->getObject()->getChemin(),
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 500px; max-height: 500px;')),
            'sujet' => new sfWidgetFormTextarea(),
            'id_docachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
            'id_titrebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
'id_orderservicecontrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ordredeservicecontratachat'), 'add_empty' => true)),       
	   'id_pvreceptionmarche'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvrception'), 'add_empty' => true)),
	    'id_marche'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),));
	   

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'chemin' => new sfValidatorFile(array('required' => false, 'path' => 'uploads/scanner/'.$this->getObject()->getChemin())),
            'objet' => new sfValidatorString(array('required' => false)),
            'sujet' => new sfValidatorString(array('required' => false)),
            'id_typepiece' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiece'), 'required' => false)),
            'id_courrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'), 'required' => false)),
//                 'id_parcour' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Parcourcourier'), 'required' => false)),
                 'id_docachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
        'id_titrebudget'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
 'id_orderservicecontrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ordredeservicecontratachat'), 'required' => false)),       
	'id_pvreceptionmarche'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pvrception'), 'required' => false)),  
  'id_marche'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'required' => false)),
     'id_parametragesociete'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Parametragesociete'), 'required' => false)),
            'id_fichederogation'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_9'), 'required' => false)),
   
  ));

        $this->widgetSchema->setNameFormat('piecejoint[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Piecejoint';
    }

}
