<?php

/**
 * Ligneoperationcaisse form base class.
 *
 * @method Ligneoperationcaisse getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneoperationcaisseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_type'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
      'id_categorie'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorieoperation'), 'add_empty' => true)),
      'dateoperation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'mntoperation'  => new sfWidgetFormInputText(),
      'retenueirrp'   => new sfWidgetFormInputText(),
      'retenuetva'    => new sfWidgetFormInputText(),
      'id_docachat'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_caisse'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'numeroo'       => new sfWidgetFormInputText(),
      'chequen'       => new sfWidgetFormInputText(),
      'objet'         => new sfWidgetFormInputText(),
      'etat'          => new sfWidgetFormInputText(),
      'id_budget'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_demarcheur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demarcheur'), 'add_empty' => true)),
      'id_user'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_type'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'column' => 'id', 'required' => false)),
      'id_categorie'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categorieoperation'), 'column' => 'id', 'required' => false)),
      'dateoperation' => new sfValidatorDate(array('required' => false)),
      'mntoperation'  => new sfValidatorNumber(array('required' => false)),
      'retenueirrp'   => new sfValidatorNumber(array('required' => false)),
      'retenuetva'    => new sfValidatorNumber(array('required' => false)),
      'id_docachat'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'id_caisse'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id', 'required' => false)),
      'numeroo'       => new sfValidatorInteger(array('required' => false)),
      'chequen'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'objet'         => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'etat'          => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_budget'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'id_demarcheur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demarcheur'), 'column' => 'id', 'required' => false)),
      'id_user'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneoperationcaisse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneoperationcaisse';
  }

}
