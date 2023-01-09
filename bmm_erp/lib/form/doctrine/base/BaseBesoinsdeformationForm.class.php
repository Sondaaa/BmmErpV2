<?php

/**
 * Besoinsdeformation form base class.
 *
 * @method Besoinsdeformation getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBesoinsdeformationForm extends BaseFormDoctrine {

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
            'besoins' => new sfWidgetFormTextarea(),
            'competance' => new sfWidgetFormTextarea(),
            'annee' => new sfWidgetFormInputText(),
            'id_contrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
            'id_poste' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
            'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
        ));


        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'besoins' => new sfValidatorString(array('required' => false)),
            'competance' => new sfValidatorString(array('required' => false)),
            'annee' => new sfValidatorString(array('required' => false)),
            'id_contrat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
            'id_poste' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'required' => false)),
            'id_unite' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('besoinsdeformation[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Besoinsdeformation';
    }

}
