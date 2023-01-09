<?php

/**
 * Historiquecontratouvrier form base class.
 *
 * @method Historiquecontratouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseHistoriquecontratouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'daterecrutement'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datedebutcontrat'  => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefoncontrat'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montant'           => new sfWidgetFormInputText(),
      'id_specialite'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'add_empty' => true)),
      'id_lieu'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'add_empty' => true)),
      'id_chantier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'add_empty' => true)),
      'id_situtaion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'add_empty' => true)),
      'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
      'nbjour'            => new sfWidgetFormInputText(),
      'montanttotal'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'daterecrutement'   => new sfValidatorDate(array('required' => false)),
      'datedebutcontrat'  => new sfValidatorDate(array('required' => false)),
      'datefoncontrat'    => new sfValidatorDate(array('required' => false)),
      'montant'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_specialite'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiteouvrier'), 'column' => 'id', 'required' => false)),
      'id_lieu'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuaffectationouvrier'), 'column' => 'id', 'required' => false)),
      'id_chantier'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Chantier'), 'column' => 'id', 'required' => false)),
      'id_situtaion'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Situationadminouvrier'), 'column' => 'id', 'required' => false)),
      'id_contratouvrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id', 'required' => false)),
      'nbjour'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montanttotal'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('historiquecontratouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquecontratouvrier';
  }

}
