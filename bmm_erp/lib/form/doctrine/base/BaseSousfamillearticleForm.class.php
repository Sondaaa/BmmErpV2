<?php

/**
 * Sousfamillearticle form base class.
 *
 * @method Sousfamillearticle getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSousfamillearticleForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'code' => new sfWidgetFormInputText(),
            'libelle' => new sfWidgetFormInputText(),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'libelle' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'id_famille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'required' => false)),
            'code' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('sousfamillearticle[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Sousfamillearticle';
    }

}
