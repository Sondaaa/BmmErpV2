<?php

/**
 * Parametreuniterepartition form base class.
 *
 * @method Parametreuniterepartition getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParametreuniterepartitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'typemecanisation'       => new sfWidgetFormInputText(),
      'id_chantierrepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'add_empty' => true)),
      'id_rapporttravaux'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
      'id_uniterepartition'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typemecanisation'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'id_chantierrepartition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'required' => false)),
      'id_rapporttravaux'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'required' => false)),
      'id_uniterepartition'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametreuniterepartition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametreuniterepartition';
  }

}
