<?php

/**
 * Lignecodesociale form base class.
 *
 * @method Lignecodesociale getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignecodesocialeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_codesoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
      'nordre'     => new sfWidgetFormInputText(),
      'libelle'    => new sfWidgetFormInputText(),
      'taux'       => new sfWidgetFormInputText(),
      'code'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_codesoc' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id', 'required' => false)),
      'nordre'     => new sfValidatorInteger(array('required' => false)),
      'libelle'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'taux'       => new sfValidatorNumber(array('required' => false)),
      'code'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignecodesociale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecodesociale';
  }

}
