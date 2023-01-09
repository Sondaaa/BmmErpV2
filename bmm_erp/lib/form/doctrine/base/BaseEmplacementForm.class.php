<?php

/**
 * Emplacement form base class.
 *
 * @method Emplacement getObject() Returns the current form's model object
 *
 * @package    InventaireTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmplacementForm extends BaseFormDoctrine {
    public function setup() {
        $this->setWidgets(array(
                'id'            => new sfWidgetFormInputHidden(),
                'dateaffectation'      => new sfWidgetFormInputText(array(),array('type'=>'date')),
                'id_pays'       => new sfWidgetFormInputText(),
                'id_gouvernera' => new sfWidgetFormInputText(),
                'id_site'       => new sfWidgetFormInputText(),
                'id_etage'      => new sfWidgetFormInputText(),
                'id_bureau'     => new sfWidgetFormInputText(),
                'id_user'       => new sfWidgetFormInputText(),
                'adresse'       => new sfWidgetFormTextarea(),
                'id_immo'       => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
                'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                'dateaffectation'      => new sfValidatorString(array('required' => false)),
                'id_pays'       => new sfValidatorInteger(array('required' => false)),
                'id_gouvernera' => new sfValidatorInteger(array('required' => false)),
                'id_site'       => new sfValidatorInteger(array('required' => false)),
                'id_etage'      => new sfValidatorInteger(array('required' => false)),
                'id_bureau'     => new sfValidatorInteger(array('required' => false)),
                'id_user'       => new sfValidatorInteger(array('required' => false)),
                'adresse'       => new sfValidatorString(array('required' => false)),
                'id_immo'       => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('emplacement[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Emplacement';
    }

}
