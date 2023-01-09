<?php

/**
 * Salairedebase form base class.
 *
 * @method Salairedebase getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSalairedebaseForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'add_empty' => true)),
            'id_echelle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Echelle'), 'add_empty' => true)),
            'id_echelon' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Echelon'), 'add_empty' => true)),
            'motant' => new sfWidgetFormInputText(),
            'id_grade' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
            'id_corps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'add_empty' => true)),
            'id_souscorps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'add_empty' => true)),
            'dateouverture' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datefermeture' => new sfWidgetFormInputText(array(), array('type' => 'date')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_categorie' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categorierh'), 'required' => false)),
            'id_echelle' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Echelle'), 'required' => false)),
            'id_echelon' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Echelon'), 'required' => false)),
            'motant' => new sfValidatorNumber(array('required' => false)),
            'id_grade' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'required' => false)),
            'id_corps' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'required' => false)),
            'id_souscorps' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'required' => false)),
            'dateouverture' => new sfValidatorDate(array('required' => false)),
            'datefermeture' => new sfValidatorDate(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('salairedebase[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Salairedebase';
    }

}
