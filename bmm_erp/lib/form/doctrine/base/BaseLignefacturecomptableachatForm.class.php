<?php

/**
 * Lignefacturecomptableachat form base class.
 *
 * @method Lignefacturecomptableachat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignefacturecomptableachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'totalht'                  => new sfWidgetFormInputText(),
      'totaltva'                 => new sfWidgetFormInputText(),
      'id_tva'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'id_facturecomptableachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'totalht'                  => new sfValidatorNumber(array('required' => false)),
      'totaltva'                 => new sfValidatorNumber(array('required' => false)),
      'id_tva'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'column' => 'id', 'required' => false)),
      'id_facturecomptableachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignefacturecomptableachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefacturecomptableachat';
  }

}
