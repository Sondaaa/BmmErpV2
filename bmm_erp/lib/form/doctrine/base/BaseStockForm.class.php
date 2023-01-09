<?php

/**
 * Stock form base class.
 *
 * @method Stock getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStockForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'datedentre' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'puht' => new sfWidgetFormInputText(array(), array('class' => 'disabledbutton')),
            'qtereel' => new sfWidgetFormInputText(array(), array('class' => 'disabledbutton')),
            'qtetheorique' => new sfWidgetFormInputText(array(), array('class' => 'disabledbutton')),
            'valeurreel' => new sfWidgetFormInputText(array(), array('class' => 'disabledbutton')),
            'stockmax' => new sfWidgetFormInputText(),
            'stockmin' => new sfWidgetFormInputText(),
            'stocksecurite' => new sfWidgetFormInputText(),
            'stockalert' => new sfWidgetFormInputText(),
            'id_article' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
            'id_mag' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
            'id_store' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Storemag'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_article' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'required' => false)),
            'id_mag' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'required' => false)),
            'datedentre' => new sfValidatorDate(array('required' => false)),
            'qtereel' => new sfValidatorNumber(array('required' => false)),
            'qtetheorique' => new sfValidatorNumber(array('required' => false)),
            'valeurreel' => new sfValidatorNumber(array('required' => false)),
            'stockmax' => new sfValidatorNumber(array('required' => false)),
            'stockmin' => new sfValidatorNumber(array('required' => false)),
            'stocksecurite' => new sfValidatorNumber(array('required' => false)),
            'stockalert' => new sfValidatorNumber(array('required' => false)),
            'id_store' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Storemag'), 'required' => false)),
            'puht' => new sfValidatorNumber(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('stock[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Stock';
    }

}
