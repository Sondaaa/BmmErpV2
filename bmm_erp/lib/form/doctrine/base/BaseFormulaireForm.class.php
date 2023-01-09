<?php

/**
 * Formulaire form base class.
 *
 * @method Formulaire getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormulaireForm extends BaseFormDoctrine {

    public function setup() {
        $array = array("" => "", "الحالة الثانوية : مبـــــــاشــــرة " => "الحالة الثانوية : مبـــــــاشــــرة  ", "الحالة الثانوية في عطلة مرض طويل الأمد" => "الحالة الثانوية في عطلة مرض طويل الأمد", "الحالة الثانوية موضــوع علــى الذمـة " => "الحالة الثانوية موضــوع علــى الذمـة ", "الإلحـــاق" => "الإلحـــاق", "عدم المباشرة" => "عدم المباشرة", "تحت السلاح" => "تحت السلاح");

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
            
            'note2' => new sfWidgetFormInputText(),
            'note3' => new sfWidgetFormInputText(),
            'note1' => new sfWidgetFormInputText(),
            'total' => new sfWidgetFormInputText(),
            'mayen' => new sfWidgetFormInputText(),
            'dureemois' => new sfWidgetFormInputText(),
            'dureejou' => new sfWidgetFormInputText(),
            'nbpointmois' => new sfWidgetFormInputText(),
            'nbrponitsjour' => new sfWidgetFormInputText(),
            'totalpoint' => new sfWidgetFormInputText(),
            'nbrpointsancien' => new sfWidgetFormInputText(),
            'nbrpointjouranci' => new sfWidgetFormInputText(),
            'totalponitanci' => new sfWidgetFormInputText(),
            'etat' => new sfWidgetFormChoice(array('choices' => $array)),
            'ancienete' => new sfWidgetFormInputText(),
			'cheminsignature'   => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                        'label'        => "Photo",
                        // Lien de la photo à afficher
                        'file_src'     => sfconfig::get('sf_appdir').'uploads/images/'.$this->getObject()->getCheminsignature(),
                        // à vrai
                        'is_image'     => true)),

        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
           
            'id_contrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
           
            'note2' => new sfValidatorInteger(array('required' => false)),
            'note3' => new sfValidatorInteger(array('required' => false)),
            'note1' => new sfValidatorInteger(array('required' => false)),
            'total' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'mayen' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'dureemois' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'dureejou' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'nbpointmois' => new sfValidatorInteger(array('required' => false)),
            'nbrponitsjour' => new sfValidatorInteger(array('required' => false)),
            'totalpoint' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'nbrpointsancien' => new sfValidatorInteger(array('required' => false)),
            'nbrpointjouranci' => new sfValidatorInteger(array('required' => false)),
            'totalponitanci' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'etat' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'ancienete' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
			  'cheminsignature'   => new  sfValidatorFile(array('required' => false,'path' => 'uploads/images/', 'mime_types' => 'web_images')),
        ));

        $this->widgetSchema->setNameFormat('formulaire[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Formulaire';
    }

}
