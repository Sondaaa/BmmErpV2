<?php

/**
 * Magasin form base class.
 *
 * @method Magasin getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMagasinForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'libelle'        => new sfWidgetFormInputText(),
      'id_pay'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_gouvernera'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_emplacement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'add_empty' => true)),
      'id_site'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'id_mag'         => new sfWidgetFormInputText(),
      'code'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'        => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_pay'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'column' => 'id', 'required' => false)),
      'id_gouvernera'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id', 'required' => false)),
      'id_emplacement' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'column' => 'id', 'required' => false)),
      'id_site'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id', 'required' => false)),
      'id_mag'         => new sfValidatorInteger(array('required' => false)),
      'code'           => new sfValidatorString(array('max_length' => 7, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('magasin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Magasin';
  }

}
