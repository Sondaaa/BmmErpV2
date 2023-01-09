<?php

/**
 * Annexebudgetligne form base class.
 *
 * @method Annexebudgetligne getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAnnexebudgetligneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'rang'            => new sfWidgetFormTextarea(),
      'libelle'         => new sfWidgetFormTextarea(),
      'type'            => new sfWidgetFormTextarea(),
      'nature'          => new sfWidgetFormTextarea(),
      'formule'         => new sfWidgetFormTextarea(),
      'sommation'       => new sfWidgetFormInputCheckbox(),
      'total'           => new sfWidgetFormInputCheckbox(),
      'id_annexebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Annexebudget'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'rang'            => new sfValidatorString(array('required' => false)),
      'libelle'         => new sfValidatorString(array('required' => false)),
      'type'            => new sfValidatorString(array('required' => false)),
      'nature'          => new sfValidatorString(array('required' => false)),
      'formule'         => new sfValidatorString(array('required' => false)),
      'sommation'       => new sfValidatorBoolean(array('required' => false)),
      'total'           => new sfValidatorBoolean(array('required' => false)),
      'id_annexebudget' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Annexebudget'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('annexebudgetligne[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annexebudgetligne';
  }

}
