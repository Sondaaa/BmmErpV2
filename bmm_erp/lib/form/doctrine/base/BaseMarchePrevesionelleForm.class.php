<?php

/**
 * MarchePrevesionelle form base class.
 *
 * @method MarchePrevesionelle getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseMarchePrevesionelleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormTextarea(),
      'id'                => new sfWidgetFormInputHidden(),
      'nbre_jour'         => new sfWidgetFormInputText(),
      'id_methode'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MethodeConclusion'), 'add_empty' => true)),
      'id_exercice'        => new sfWidgetFormDoctrineChoice(array('model' => 'Exercice','table_method' => 'getExerciceBudget', 'add_empty' => true)),
      'id_procedure'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProcedureMarche'), 'add_empty' => true)),
      'id_sources'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SourceMarcheprevesionelle'), 'add_empty' => true)),
      'created_cahier'    => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_annonce'      => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_overture'     => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_nomination'   => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_transmission' => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_reponse'      => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_edition'      => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_notifier'     => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'date_commencement' => new sfWidgetFormInput(array(),array('type'=>'date','class'=>'form-control date-picker')),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorString(array('required' => false)),
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nbre_jour'         => new sfValidatorInteger(array('required' => false)),
      'id_methode'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MethodeConclusion'), 'column' => 'id', 'required' => false)),
      'id_exercice'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
      'id_procedure'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProcedureMarche'), 'column' => 'id', 'required' => false)),
      'id_sources'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SourceMarcheprevesionelle'), 'column' => 'id', 'required' => false)),
      'created_cahier'    => new sfValidatorDate(array('required' => false)),
      'date_annonce'      => new sfValidatorDate(array('required' => false)),
      'date_overture'     => new sfValidatorDate(array('required' => false)),
      'date_nomination'   => new sfValidatorDate(array('required' => false)),
      'date_transmission' => new sfValidatorDate(array('required' => false)),
      'date_reponse'      => new sfValidatorDate(array('required' => false)),
      'date_edition'      => new sfValidatorDate(array('required' => false)),
      'date_notifier'     => new sfValidatorDate(array('required' => false)),
      'date_commencement' => new sfValidatorDate(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('marche_prevesionelle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MarchePrevesionelle';
  }

}
