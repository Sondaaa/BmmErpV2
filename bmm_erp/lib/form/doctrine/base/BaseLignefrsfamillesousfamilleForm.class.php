<?php

/**
 * Lignefrsfamillesousfamille form base class.
 *
 * @method Lignefrsfamillesousfamille getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignefrsfamillesousfamilleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_frs'         => new sfWidgetFormInputText(),
      'id_famille'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familletiers'), 'add_empty' => true)),
      'id_sousfamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamilletiers'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_frs'         => new sfValidatorInteger(array('required' => false)),
      'id_famille'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Familletiers'), 'column' => 'id', 'required' => false)),
      'id_sousfamille' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamilletiers'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignefrsfamillesousfamille[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefrsfamillesousfamille';
  }

}
