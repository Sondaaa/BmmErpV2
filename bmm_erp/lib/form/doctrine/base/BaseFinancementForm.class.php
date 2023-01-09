<?php

/**
 * Financement form base class.
 *
 * @method Financement getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFinancementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'mntht'               => new sfWidgetFormInputText(),
      'tauxtva'             => new sfWidgetFormInputText(),
      'mntttc'              => new sfWidgetFormInputText(),
      'mnttva'              => new sfWidgetFormInputText(),
      'caracteristiqueprix' => new sfWidgetFormInputText(),
      'natureprix'          => new sfWidgetFormInputText(),
      'id_lignebudget'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_marche'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),
      'id_tva'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mntht'               => new sfValidatorNumber(array('required' => false)),
      'tauxtva'             => new sfValidatorNumber(array('required' => false)),
      'mntttc'              => new sfValidatorNumber(array('required' => false)),
      'mnttva'              => new sfValidatorNumber(array('required' => false)),
      'caracteristiqueprix' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'natureprix'          => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'id_lignebudget'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'required' => false)),
      'id_marche'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'required' => false)),
      'id_tva'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('financement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Financement';
  }

}
