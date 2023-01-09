<?php

/**
 * Compterepartitionsalaireouvrier form base class.
 *
 * @method Compterepartitionsalaireouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCompterepartitionsalaireouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_repartition'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'add_empty' => true)),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_repartition'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'column' => 'id', 'required' => false)),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('compterepartitionsalaireouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compterepartitionsalaireouvrier';
  }

}
