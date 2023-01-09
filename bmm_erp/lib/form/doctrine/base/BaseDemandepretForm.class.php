<?php

/**
 * Demandepret form base class.
 *
 * @method Demandepret getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandepretForm extends BaseFormDoctrine {

    public function setup() {
        $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->from('Agents a')
                ->leftJoin('a.Contrat c')
                ->where('a.id_regrouppement=1')
                ->andWhere('c.id_typecontrat=1')
                ->andWhere('a.id_motifabsence IS NULL ')
                ->orderBy('a.nomcomplet')
                ->execute();

        $choices_agents = array();
        $choices_agents[0] = '';
        foreach ($agents as $req) {
            $choices_agents[$req->getId()] = $req->getIdrh() . ' ' . $req->getNomcomplet() . ' ' . $req->getPrenom();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_agents' => new sfWidgetFormChoice(array('choices' => $choices_agents)),
            'montantpret' => new sfWidgetFormInputText(),
            'datedemande' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'lieu' => new sfWidgetFormInputText(),
            'situationmulitaire' => new sfWidgetFormInputText(),
            'salairebrut' => new sfWidgetFormInputText(),
            'id_typepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'add_empty' => true)),
            'datedebutretenue' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefinretenue' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrmois' => new sfWidgetFormInputText(),
            'montantmentielle' => new sfWidgetFormInputText(),
            'mois' => new sfWidgetFormInputText(),
            'annee' => new sfWidgetFormInputText(),
            'id_sourcepret' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'add_empty' => true)),
            'societe' => new sfWidgetFormInputText(),
            'numerodecnss' => new sfWidgetFormInputText(),
            'paye' => new sfWidgetFormInputCheckbox(),
            'valide' => new sfWidgetFormInputCheckbox(),
            'signature' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/demandepret/' . $this->getObject()->getSignature(),
                'edit_mode' => !$this->isNew(),
                'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
            'id_validateur' => new sfWidgetFormChoice(array('choices' => $choices_agents)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'montantpret' => new sfValidatorNumber(array('required' => false)),
            'datedemande' => new sfValidatorDate(array('required' => false)),
            'lieu' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'situationmulitaire' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'salairebrut' => new sfValidatorNumber(array('required' => false)),
            'id_typepret' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'required' => false)),
            'datedebutretenue' => new sfValidatorDate(array('required' => false)),
            'datefinretenue' => new sfValidatorDate(array('required' => false)),
            'nbrmois' => new sfValidatorInteger(array('required' => false)),
            'montantmentielle' => new sfValidatorNumber(array('required' => false)),
            'mois' => new sfValidatorInteger(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'id_sourcepret' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcepret'), 'required' => false)),
            'societe' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'numerodecnss' => new sfValidatorInteger(array('required' => false)),
            'paye' => new sfValidatorBoolean(array('required' => false)),
            'valide' => new sfValidatorBoolean(array('required' => false)),
            'signature' => new sfValidatorString(array('max_length' => 225, 'required' => false)),
            'id_validateur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_5'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('demandepret[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Demandepret';
    }

}
