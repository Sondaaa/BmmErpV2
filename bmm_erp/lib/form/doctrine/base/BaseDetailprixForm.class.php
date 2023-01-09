<?php

/**
 * Detailprix form base class.
 *
 * @method Detailprix getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetailprixForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'totalgeneral'      => new sfWidgetFormInputText(),
      'rrr'               => new sfWidgetFormInputText(),
      'totalapresremise'  => new sfWidgetFormInputText(),
      'id_tva'            => new sfWidgetFormInputText(),
      'tauxtva'           => new sfWidgetFormInputText(),
      'mnttva'            => new sfWidgetFormInputText(),
      'retenuegarentie'   => new sfWidgetFormInputText(),
      'total'             => new sfWidgetFormInputText(),
      'deponseantirieur'  => new sfWidgetFormInputText(),
      'netapayer'         => new sfWidgetFormInputText(),
      'htva'              => new sfWidgetFormInputText(),
      'datecreation'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_lots'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
      'id_typedetailprix' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedetailprix'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'totalgeneral'      => new sfValidatorNumber(array('required' => false)),
      'rrr'               => new sfValidatorNumber(array('required' => false)),
      'totalapresremise'  => new sfValidatorNumber(array('required' => false)),
      'id_tva'            => new sfValidatorInteger(array('required' => false)),
      'tauxtva'           => new sfValidatorNumber(array('required' => false)),
      'mnttva'            => new sfValidatorNumber(array('required' => false)),
      'retenuegarentie'   => new sfValidatorNumber(array('required' => false)),
      'total'             => new sfValidatorNumber(array('required' => false)),
      'deponseantirieur'  => new sfValidatorNumber(array('required' => false)),
      'netapayer'         => new sfValidatorNumber(array('required' => false)),
      'htva'              => new sfValidatorNumber(array('required' => false)),
      'datecreation'      => new sfValidatorDate(array('required' => false)),
      'id_lots'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'required' => false)),
      'id_typedetailprix' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedetailprix'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detailprix[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Detailprix';
  }

}
