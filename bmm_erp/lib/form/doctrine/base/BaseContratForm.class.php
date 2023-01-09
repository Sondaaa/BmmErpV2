<?php

/**
 * Contrat form base class.
 *
 * @method Contrat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseContratForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'dateaccusition'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datevalidesalaire'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dateemposte'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_codesociale'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
      'id_poste'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Poste'), 'add_empty' => true)),
      'id_unite'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'add_empty' => true)),
      'idunique'             => new sfWidgetFormInputText(),
      'dateaffiliation'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_typecontrat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'add_empty' => true)),
      'datetitulaire'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_regime'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'ncnss'                => new sfWidgetFormInputText(),
      'observation'          => new sfWidgetFormInputText(),
      'id_fonction'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'add_empty' => true)),
      'id_agents'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_grade'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'add_empty' => true)),
      'id_salairedebase'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'add_empty' => true)),
      'numinscri'            => new sfWidgetFormInputText(),
      'specialite'           => new sfWidgetFormInputText(),
      'fonctionapp'          => new sfWidgetFormInputText(),
      'datepromotions'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_gouv'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_gouvernerat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernerat'), 'add_empty' => true)),
      'id_posterh'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
      'dateechelle'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dateechelon'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dategrade'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'dateeffet'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_graderec'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_10'), 'add_empty' => true)),
      'id_gradetitu'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_11'), 'add_empty' => true)),
      'montant'              => new sfWidgetFormInputText(),
      'idsalaire'            => new sfWidgetFormInputText(),
      'id_lieu'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'add_empty' => true)),
      'id_naturepromo'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'add_empty' => true)),
      'id_positionadmini'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Positionadministratif'), 'add_empty' => true)),
      'id_retratite'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'add_empty' => true)),
      'dateretraite'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'salairetheorique'     => new sfWidgetFormInputText(),
      'id_lignecodesociale'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'add_empty' => true)),
      'id_lignecontribition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'add_empty' => true)),
      'totaltauxsociale'     => new sfWidgetFormInputText(),
      'id_contribiton'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dateaccusition'       => new sfValidatorDate(array('required' => false)),
      'datevalidesalaire'    => new sfValidatorDate(array('required' => false)),
      'dateemposte'          => new sfValidatorDate(array('required' => false)),
      'id_codesociale'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id', 'required' => false)),
      'id_poste'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Poste'), 'column' => 'id', 'required' => false)),
      'id_unite'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unite'), 'column' => 'id', 'required' => false)),
      'idunique'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'dateaffiliation'      => new sfValidatorDate(array('required' => false)),
      'id_typecontrat'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecontrat'), 'column' => 'id', 'required' => false)),
      'datetitulaire'        => new sfValidatorDate(array('required' => false)),
      'id_regime'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id', 'required' => false)),
      'ncnss'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'observation'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_fonction'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fonction'), 'column' => 'id', 'required' => false)),
      'id_agents'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_grade'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grade'), 'column' => 'id', 'required' => false)),
      'id_salairedebase'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Salairedebase'), 'column' => 'id', 'required' => false)),
      'numinscri'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'specialite'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fonctionapp'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'datepromotions'       => new sfValidatorDate(array('required' => false)),
      'id_gouv'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id', 'required' => false)),
      'id_gouvernerat'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernerat'), 'column' => 'id', 'required' => false)),
      'id_posterh'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'column' => 'id', 'required' => false)),
      'dateechelle'          => new sfValidatorDate(array('required' => false)),
      'dateechelon'          => new sfValidatorDate(array('required' => false)),
      'dategrade'            => new sfValidatorDate(array('required' => false)),
      'dateeffet'            => new sfValidatorDate(array('required' => false)),
      'id_graderec'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_10'), 'column' => 'id', 'required' => false)),
      'id_gradetitu'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grade_11'), 'column' => 'id', 'required' => false)),
      'montant'              => new sfValidatorNumber(array('required' => false)),
      'idsalaire'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_lieu'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieutravail'), 'column' => 'id', 'required' => false)),
      'id_naturepromo'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturepromotion'), 'column' => 'id', 'required' => false)),
      'id_positionadmini'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Positionadministratif'), 'column' => 'id', 'required' => false)),
      'id_retratite'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Retraite'), 'column' => 'id', 'required' => false)),
      'dateretraite'         => new sfValidatorDate(array('required' => false)),
      'salairetheorique'     => new sfValidatorNumber(array('required' => false)),
      'id_lignecodesociale'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecodesociale'), 'column' => 'id', 'required' => false)),
      'id_lignecontribition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'column' => 'id', 'required' => false)),
      'totaltauxsociale'     => new sfValidatorNumber(array('required' => false)),
      'id_contribiton'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contrat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contrat';
  }

}
