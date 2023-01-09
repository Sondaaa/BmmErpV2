<?php

/**
 * Expdest form base class.
 *
 * @method Expdest getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExpdestForm extends BaseFormDoctrine {

    public function setup() {
        if ($this->getObject()->isnew())
            $date = date('Y-m-d');
        else
            $date = $this->getObject()->getDatecreation();
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date', 'value' => $date, 'class' => 'disabledbutton')),
            // 'maxdate'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typexpdes'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'npresponsable' => new sfWidgetFormInputText(),
            'rs' => new sfWidgetFormInputText(),
            'matricule' => new sfWidgetFormInputText(),
             'tel' => new sfWidgetFormInputText(),
            'gsm' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'fax' => new sfWidgetFormInputText(),
            'adr' => new sfWidgetFormInputText(),
            'codepostal' => new sfWidgetFormInputText(),
            'id_gouvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
             ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'datecreation' => new sfValidatorDate(array('required' => false)),
            //'maxdate'       => new sfValidatorDate(array('required' => false)),
            'npresponsable' => new sfValidatorString(array('required' => false)),
            'rs' => new sfValidatorString(array('required' => false)),
            'matricule' => new sfValidatorString(array('required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typexpdes'), 'required' => false)),
            'id_famille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'required' => false)),
            'id_agent' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'tel' => new sfValidatorString(array( 'required' => false)),
            'gsm' => new sfValidatorString(array( 'required' => false)),
            'email' => new sfValidatorString(array( 'required' => false)),
            'fax' => new sfValidatorString(array( 'required' => false)),
            'adr' => new sfValidatorString(array( 'required' => false)),
            'codepostal' => new sfValidatorString(array( 'required' => false)),
            'id_gouvernera' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'required' => false)),
            'id_frs' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('expdest[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Expdest';
    }

}
