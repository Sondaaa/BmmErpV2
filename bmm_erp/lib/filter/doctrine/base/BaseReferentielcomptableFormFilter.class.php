<?php

/**
 * Referentielcomptable filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReferentielcomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
	    $etat = array("0" => "Réferentiel", "1" => "Document Utile");
    $this->setWidgets(array(
      'libelle'        => new sfWidgetFormFilterInput(),
      'url'            => new sfWidgetFormFilterInput(),
      'id_utilisateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_dossier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'standard'       => new sfWidgetFormChoice(array('choices' => $etat)),
      'description'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'url'            => new sfValidatorPass(array('required' => false)),
      'id_utilisateur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_dossier'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'standard'       => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('referentielcomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Referentielcomptable';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'libelle'        => 'Text',
      'url'            => 'Text',
      'id_utilisateur' => 'ForeignKey',
      'id_dossier'     => 'ForeignKey',
      'standard'       => 'Text',
      'description'    => 'Text',
    );
  }
}
