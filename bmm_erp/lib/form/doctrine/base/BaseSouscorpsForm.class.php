<?php

/**
 * Souscorps form base class.
 *
 * @method Souscorps getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseSouscorpsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'libelle'  => new sfWidgetFormInputText(),
      'id_corps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_corps' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('souscorps[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Souscorps';
  }

}
