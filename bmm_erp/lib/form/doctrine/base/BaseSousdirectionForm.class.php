<?php

/**
 * Sousdirection form base class.
 *
 * @method Sousdirection getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseSousdirectionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'libelle'      => new sfWidgetFormInputText(),
      'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_direction' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousdirection[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousdirection';
  }

}
