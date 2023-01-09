<?php

/**
 * Marches form base class.
 *
 * @method Marches getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMarchesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'numero'           => new sfWidgetFormInputText(),
      'datecreation'     => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'delai'            => new sfWidgetFormInputText(),
      'object'           => new sfWidgetFormTextarea(),
      'mrpme'            => new sfWidgetFormInputText(),
      'nbrelot'          => new sfWidgetFormInputText(),
      'titulaire'        => new sfWidgetFormInputText(),
      'nbrebinificaire'  => new sfWidgetFormInputText(),
      'mntttc'           => new sfWidgetFormInputText(),
      'retenuegaraentie' => new sfWidgetFormInputText(),
      'cautionement'     => new sfWidgetFormInputText(),
      'avance'           => new sfWidgetFormInputText(),
      'penalite'         => new sfWidgetFormInputText(),
      'id_passaction'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Procedurepassation'), 'add_empty' => true)),
      'id_projet'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_nature'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturemarche'), 'add_empty' => true)),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_frs'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'datecommencement' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'maxpinalite'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'           => new sfValidatorInteger(array('required' => false)),
      'datecreation'     => new sfValidatorDate(array('required' => false)),
      'delai'            => new sfValidatorInteger(array('required' => false)),
      'object'           => new sfValidatorString(array('required' => false)),
      'mrpme'            => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'nbrelot'          => new sfValidatorInteger(array('required' => false)),
      'titulaire'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'nbrebinificaire'  => new sfValidatorInteger(array('required' => false)),
      'mntttc'           => new sfValidatorNumber(array('required' => false)),
      'retenuegaraentie' => new sfValidatorNumber(array('required' => false)),
      'cautionement'     => new sfValidatorNumber(array('required' => false)),
      'avance'           => new sfValidatorNumber(array('required' => false)),
      'penalite'         => new sfValidatorNumber(array('required' => false)),
      'id_passaction'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Procedurepassation'), 'column' => 'id', 'required' => false)),
      'id_projet'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'column' => 'id', 'required' => false)),
      'id_nature'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturemarche'), 'column' => 'id', 'required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'id_documentachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'id_frs'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'datecommencement' => new sfValidatorDate(array('required' => false)),
      'maxpinalite'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('marches[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Marches';
  }

}
