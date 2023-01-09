<?php

/**
 * Tvabase form base class.
 *
 * @method Tvabase getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTvabaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'libelle'    => new sfWidgetFormInputText(),
      'valeurbase' => new sfWidgetFormInputText(),
      'id_doc'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'valeurbase' => new sfValidatorNumber(array('required' => false)),
      'id_doc'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tvabase[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tvabase';
  }

}
