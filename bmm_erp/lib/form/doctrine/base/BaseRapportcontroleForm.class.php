<?php

/**
 * Rapportcontrole form base class.
 *
 * @method Rapportcontrole getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRapportcontroleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'datecreation'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_chantiercontrole' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantiercontrole'), 'add_empty' => true)),
      'id_projet'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_naturetravaux'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturetravaux'), 'add_empty' => true)),
      'total'               => new sfWidgetFormInputText(),
      'observation'         => new sfWidgetFormTextarea(),
      'id_servicecontrole'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicecontrole'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datecreation'        => new sfValidatorDate(array('required' => false)),
      'id_chantiercontrole' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantiercontrole'), 'required' => false)),
      'id_projet'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
      'id_naturetravaux'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturetravaux'), 'required' => false)),
      'total'               => new sfValidatorNumber(array('required' => false)),
      'observation'         => new sfValidatorString(array('required' => false)),
      'id_servicecontrole'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Servicecontrole'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rapportcontrole[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rapportcontrole';
  }

}
