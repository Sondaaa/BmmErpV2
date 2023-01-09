<?php

/**
 * Visitemedicale form base class.
 *
 * @method Visitemedicale getObject() Returns the current form's model object
 *
 * @package    PhpProjecttest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVisitemedicaleForm extends BaseFormDoctrine {

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
            'destination' => new sfWidgetFormInputText(),
            'datedepart' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'dateretour' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'nbrjour' => new sfWidgetFormInputText(),
            'motif' => new sfWidgetFormInputText(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'duree' => new sfWidgetFormInputText(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
            'id_destination' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatonvisitemedicale'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'destination' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'datedepart' => new sfValidatorDate(array('required' => false)),
            'dateretour' => new sfValidatorDate(array('required' => false)),
            'nbrjour' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'motif' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'duree' => new sfValidatorInteger(array('required' => false)),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'id_destination' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatonvisitemedicale'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('visitemedicale[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Visitemedicale';
    }

}
