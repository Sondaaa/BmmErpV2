<?php

/**
 * Reclamationfrs form base class.
 *
 * @method Reclamationfrs getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseReclamationfrsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'object'  => new sfWidgetFormInputText(),
      'daterec' => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'sujet'   => new sfWidgetFormTextarea(),
      'id_frs'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'object'  => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'daterec' => new sfValidatorDate(array('required' => false)),
      'sujet'   => new sfValidatorString(array('required' => false)),
      'id_frs'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reclamationfrs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reclamationfrs';
  }

}
