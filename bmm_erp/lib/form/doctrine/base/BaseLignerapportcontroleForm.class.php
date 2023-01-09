<?php

/**
 * Lignerapportcontrole form base class.
 *
 * @method Lignerapportcontrole getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignerapportcontroleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'numero'             => new sfWidgetFormInputText(),
      'designation'        => new sfWidgetFormTextarea(),
      'unite'              => new sfWidgetFormTextarea(),
      'quantite'           => new sfWidgetFormInputText(),
      'prixunitaire'       => new sfWidgetFormInputText(),
      'prixtotal'          => new sfWidgetFormInputText(),
      'observation'        => new sfWidgetFormTextarea(),
      'id_rapportcontrole' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapportcontrole'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'             => new sfValidatorInteger(array('required' => false)),
      'designation'        => new sfValidatorString(array('required' => false)),
      'unite'              => new sfValidatorString(array('required' => false)),
      'quantite'           => new sfValidatorInteger(array('required' => false)),
      'prixunitaire'       => new sfValidatorNumber(array('required' => false)),
      'prixtotal'          => new sfValidatorNumber(array('required' => false)),
      'observation'        => new sfValidatorString(array('required' => false)),
      'id_rapportcontrole' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rapportcontrole'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignerapportcontrole[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignerapportcontrole';
  }

}
