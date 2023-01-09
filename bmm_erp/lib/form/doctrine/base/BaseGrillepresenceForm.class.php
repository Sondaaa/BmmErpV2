<?php

/**
 * Grillepresence form base class.
 *
 * @method Grillepresence getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseGrillepresenceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_presnece'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'add_empty' => true)),
      'jour'          => new sfWidgetFormInputText(),
      'semaine'       => new sfWidgetFormInputText(),
      'heuresupp'     => new sfWidgetFormInputText(),
      'totalhsemaine' => new sfWidgetFormInputText(),
      'totalhsupp'    => new sfWidgetFormInputText(),
      'id_motif'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Motif'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_presnece'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'column' => 'id', 'required' => false)),
      'jour'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'semaine'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'heuresupp'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'totalhsemaine' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'totalhsupp'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_motif'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Motif'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grillepresence[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grillepresence';
  }

}
