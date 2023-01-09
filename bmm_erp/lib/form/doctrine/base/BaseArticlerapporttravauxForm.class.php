<?php

/**
 * Articlerapporttravaux form base class.
 *
 * @method Articlerapporttravaux getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticlerapporttravauxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'mre'               => new sfWidgetFormInputText(),
      'dps'               => new sfWidgetFormInputText(),
      'maint'             => new sfWidgetFormInputText(),
      'bat'               => new sfWidgetFormInputText(),
      'plant'             => new sfWidgetFormInputText(),
      'montant'           => new sfWidgetFormInputText(),
      'id_immobilisation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'id_rapporttravaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mre'               => new sfValidatorNumber(array('required' => false)),
      'dps'               => new sfValidatorNumber(array('required' => false)),
      'maint'             => new sfValidatorNumber(array('required' => false)),
      'bat'               => new sfValidatorNumber(array('required' => false)),
      'plant'             => new sfValidatorNumber(array('required' => false)),
      'montant'           => new sfValidatorNumber(array('required' => false)),
      'id_immobilisation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'required' => false)),
      'id_rapporttravaux' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articlerapporttravaux[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articlerapporttravaux';
  }

}
