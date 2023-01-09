<?php

/**
 * Recompense form base class.
 *
 * @method Recompense getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecompenseForm extends BaseFormDoctrine {

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
            'id_typerecompense' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typerecompense'), 'add_empty' => true)),
            'explication' => new sfWidgetFormInputText(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'source' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Photo",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/images/' . $this->getObject()->getSource(),
                // à vrai
                'is_image' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'id_typerecompense' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typerecompense'), 'required' => false)),
            'explication' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'source' => new sfValidatorFile(array('required' => false, 'path' => 'uploads/images/', 'mime_types' => 'web_images')),
        ));

        $this->widgetSchema->setNameFormat('recompense[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Recompense';
    }

}
