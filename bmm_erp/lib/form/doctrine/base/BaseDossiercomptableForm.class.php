<?php

/**
 * Dossiercomptable form base class.
 *
 * @method Dossiercomptable getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDossiercomptableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'date'                      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'code'                      => new sfWidgetFormInputText(),
      'raisonsociale'             => new sfWidgetFormInputText(),
      'telephoneun'               => new sfWidgetFormInputText(),
      'telephonedeux'             => new sfWidgetFormInputText(),
      'fax'                       => new sfWidgetFormInputText(),
      'email'                     => new sfWidgetFormInputText(),
      'matriculefiscale'          => new sfWidgetFormInputText(),
      'registrecommerce'          => new sfWidgetFormInputText(),
      'datedebutouverture'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datecloture'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'nombrechiffrenumerocompte' => new sfWidgetFormInputText(),
      'nombrechiffreapresvirgule' => new sfWidgetFormInputText(),
      'datecreationentreprise'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefinouverture'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_devise'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_formejuridique'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formejuridique'), 'add_empty' => true)),
      'id_adresse'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'id_secteuractivite'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteuractivite'), 'add_empty' => true)),
      'id_activite'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'add_empty' => true)),
      'id_user'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_compteattente'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CompteAttente'), 'add_empty' => true)),
      'id_comptevente'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CompteVente'), 'add_empty' => true)),
      'id_compteachat'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CompteAchat'), 'add_empty' => true)),
      'archive'                   => new sfWidgetFormInputCheckbox(),
      'id_exercice'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'tauxtfp'                   => new sfWidgetFormInputText(),
      'tauxfoprolos'              => new sfWidgetFormInputText(),
      'id_typeregime'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'dateentreenproduction'     => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefinavantage'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'nbravantage'               => new sfWidgetFormInputText(),
      'calculheuresupp'           => new sfWidgetFormInputText(),
      'qualificationcnss'         => new sfWidgetFormInputCheckbox(),
      'situationprofess'          => new sfWidgetFormInputCheckbox(),
      'dateembauche'              => new sfWidgetFormInputCheckbox(),
      'rib'                       => new sfWidgetFormInputCheckbox(),
      'soldeconge'                => new sfWidgetFormInputCheckbox(),
      'periode'                   => new sfWidgetFormInputCheckbox(),
      'mntlibelleprime'           => new sfWidgetFormInputCheckbox(),
      'lignessp'                  => new sfWidgetFormInputCheckbox(),
      'editgrille'                => new sfWidgetFormInputCheckbox(),
      'reparation'                => new sfWidgetFormInputCheckbox(),
      'controlerevenue'           => new sfWidgetFormInputCheckbox(),
      'journalpaie'               => new sfWidgetFormInputCheckbox(),
      'assurancejouralpaie'       => new sfWidgetFormInputCheckbox(),
      'tfp'                       => new sfWidgetFormInputCheckbox(),
      'foprolos'                  => new sfWidgetFormInputCheckbox(),
      'id_contribution'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'tauxaccidentcotisation'    => new sfWidgetFormInputText(),
      'id_lignecontribition'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'add_empty' => true)),
      'etat'                      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                      => new sfValidatorDate(),
      'code'                      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'raisonsociale'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'telephoneun'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'telephonedeux'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fax'                       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'email'                     => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'matriculefiscale'          => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'registrecommerce'          => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'datedebutouverture'        => new sfValidatorDate(array('required' => false)),
      'datecloture'               => new sfValidatorDate(array('required' => false)),
      'nombrechiffrenumerocompte' => new sfValidatorInteger(array('required' => false)),
      'nombrechiffreapresvirgule' => new sfValidatorInteger(array('required' => false)),
      'datecreationentreprise'    => new sfValidatorDate(array('required' => false)),
      'datefinouverture'          => new sfValidatorDate(array('required' => false)),
      'id_devise'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'column' => 'id', 'required' => false)),
      'id_formejuridique'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formejuridique'), 'column' => 'id', 'required' => false)),
      'id_adresse'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'column' => 'id', 'required' => false)),
      'id_secteuractivite'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteuractivite'), 'column' => 'id', 'required' => false)),
      'id_activite'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'column' => 'id', 'required' => false)),
      'id_user'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'id_compteattente'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CompteAttente'), 'column' => 'id', 'required' => false)),
      'id_comptevente'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CompteVente'), 'column' => 'id', 'required' => false)),
      'id_compteachat'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CompteAchat'), 'column' => 'id', 'required' => false)),
      'archive'                   => new sfValidatorBoolean(array('required' => false)),
      'id_exercice'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
      'tauxtfp'                   => new sfValidatorInteger(array('required' => false)),
      'tauxfoprolos'              => new sfValidatorInteger(array('required' => false)),
      'id_typeregime'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id', 'required' => false)),
      'dateentreenproduction'     => new sfValidatorDate(array('required' => false)),
      'datefinavantage'           => new sfValidatorDate(array('required' => false)),
      'nbravantage'               => new sfValidatorInteger(array('required' => false)),
      'calculheuresupp'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'qualificationcnss'         => new sfValidatorBoolean(array('required' => false)),
      'situationprofess'          => new sfValidatorBoolean(array('required' => false)),
      'dateembauche'              => new sfValidatorBoolean(array('required' => false)),
      'rib'                       => new sfValidatorBoolean(array('required' => false)),
      'soldeconge'                => new sfValidatorBoolean(array('required' => false)),
      'periode'                   => new sfValidatorBoolean(array('required' => false)),
      'mntlibelleprime'           => new sfValidatorBoolean(array('required' => false)),
      'lignessp'                  => new sfValidatorBoolean(array('required' => false)),
      'editgrille'                => new sfValidatorBoolean(array('required' => false)),
      'reparation'                => new sfValidatorBoolean(array('required' => false)),
      'controlerevenue'           => new sfValidatorBoolean(array('required' => false)),
      'journalpaie'               => new sfValidatorBoolean(array('required' => false)),
      'assurancejouralpaie'       => new sfValidatorBoolean(array('required' => false)),
      'tfp'                       => new sfValidatorBoolean(array('required' => false)),
      'foprolos'                  => new sfValidatorBoolean(array('required' => false)),
      'id_contribution'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id', 'required' => false)),
      'tauxaccidentcotisation'    => new sfValidatorNumber(array('required' => false)),
      'id_lignecontribition'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'column' => 'id', 'required' => false)),
      'etat'                      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dossiercomptable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dossiercomptable';
  }

}
