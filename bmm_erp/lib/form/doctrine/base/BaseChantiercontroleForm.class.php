<?php

/**
 * Chantiercontrole form base class.
 *
 * @method Chantiercontrole getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseChantiercontroleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'datecreation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'libelle'         => new sfWidgetFormTextarea(),
      'reference'       => new sfWidgetFormTextarea(),
      'objet'           => new sfWidgetFormTextarea(),
      'attributaire'    => new sfWidgetFormTextarea(),
      'id_lieuchantier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuchantier'), 'add_empty' => true)),
      'dureeprobable'   => new sfWidgetFormTextarea(),
      'datedemarrage'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montant'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datecreation'    => new sfValidatorDate(array('required' => false)),
      'libelle'         => new sfValidatorString(array('required' => false)),
      'reference'       => new sfValidatorString(array('required' => false)),
      'objet'           => new sfValidatorString(array('required' => false)),
      'attributaire'    => new sfValidatorString(array('required' => false)),
      'id_lieuchantier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuchantier'), 'column' => 'id', 'required' => false)),
      'dureeprobable'   => new sfValidatorString(array('required' => false)),
      'datedemarrage'   => new sfValidatorDate(array('required' => false)),
      'montant'         => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('chantiercontrole[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Chantiercontrole';
  }

}
