<?php

/**
 * Historiquepositionsadministrative form base class.
 *
 * @method Historiquepositionsadministrative getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoriquepositionsadministrativeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_contrat'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'id_positionadmini' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Positionadministratif'), 'add_empty' => true)),
      'datesysteme'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contrat'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'required' => false)),
      'id_positionadmini' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Positionadministratif'), 'required' => false)),
      'datesysteme'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquepositionsadministrative[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquepositionsadministrative';
  }

}
