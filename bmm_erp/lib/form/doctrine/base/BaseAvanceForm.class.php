<?php

/**
 * Avance form base class.
 *
 * @method Avance getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAvanceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'libelle'       => new sfWidgetFormInputText(),
      'remboursement' => new sfWidgetFormInputText(),
      'id_type'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'remboursement' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_type'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('avance[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Avance';
  }

}
