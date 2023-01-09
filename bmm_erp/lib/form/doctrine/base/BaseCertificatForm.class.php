<?php

/**
 * Certificat form base class.
 *
 * @method Certificat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCertificatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_naturecertif' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecertif'), 'add_empty' => true)),
      'libellle'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_naturecertif' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecertif'), 'column' => 'id', 'required' => false)),
      'libellle'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('certificat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Certificat';
  }

}
