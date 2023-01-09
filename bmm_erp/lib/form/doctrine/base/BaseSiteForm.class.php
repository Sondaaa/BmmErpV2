<?php

/**
 * Site form base class.
 *
 * @method Site getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'site'       => new sfWidgetFormTextarea(),
      'id_societe' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'id_adresse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'site'       => new sfValidatorString(array('required' => false)),
      'id_societe' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'required' => false)),
      'id_adresse' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('site[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Site';
  }

}
