<?php

/**
 * Lignelangueagents form base class.
 *
 * @method Lignelangueagents getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignelangueagentsForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'description' => new sfWidgetFormInputText(),
            'id_langue' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Langues'), 'add_empty' => true)),
            'id_angents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'id_langue' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Langues'), 'required' => false)),
            'id_angents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'nordre' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('lignelangueagents[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Lignelangueagents';
    }

}
