<?php

/**
 * Storemag form base class.
 *
 * @method Storemag getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseStoremagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'libelle'   => new sfWidgetFormInputText(),
      'id_mag'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'   => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_mag'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'column' => 'id', 'required' => false)),
      'id_projet' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('storemag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Storemag';
  }

}
