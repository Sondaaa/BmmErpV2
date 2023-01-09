<?php

/**
 * Rapporttravaux form base class.
 *
 * @method Rapporttravaux getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRapporttravauxForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'annee' => new sfWidgetFormInputText(),
            'libelle' => new sfWidgetFormTextarea(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typerapport'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'annee' => new sfValidatorInteger(array('required' => false)),
            'libelle' => new sfValidatorString(array('required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typerapport'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('rapporttravaux[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Rapporttravaux';
    }

}
