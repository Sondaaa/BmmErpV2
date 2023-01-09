<?php

/**
 * Fournisseur filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFournisseurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'         => new sfWidgetFormFilterInput(),
      'nom'               => new sfWidgetFormFilterInput(),
      'prenom'            => new sfWidgetFormFilterInput(),
      'rs'                => new sfWidgetFormFilterInput(),
      'mail'              => new sfWidgetFormFilterInput(),
      'tel'               => new sfWidgetFormFilterInput(),
      'gsm'               => new sfWidgetFormFilterInput(),
      'id_activite'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'add_empty' => true)),
      'nfiche'            => new sfWidgetFormFilterInput(),
      'id_user'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')),
                'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'codefrs'           => new sfWidgetFormFilterInput(),
      'adr'               => new sfWidgetFormFilterInput(),
      'id_gouv'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_famillearticle' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familleartfrs'), 'add_empty' => true)),
      'observation'       => new sfWidgetFormFilterInput(),
      'compteg'           => new sfWidgetFormFilterInput(),
      'comptean'          => new sfWidgetFormFilterInput(),
      'assujtva'          => new sfWidgetFormFilterInput(),
      'fodec'             => new sfWidgetFormFilterInput(),
      'id_adresse'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'id_plancomptable'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'rib'               => new sfWidgetFormFilterInput(),
      'id_naturecompte'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'matriculefiscale'  => new sfWidgetFormFilterInput(),
      'datemisajour'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'etatfrs'           => new sfWidgetFormFilterInput(),
      'valeurfodec'       => new sfWidgetFormFilterInput(),
      'notecloture'       => new sfWidgetFormFilterInput(),
      'noteoverture'      => new sfWidgetFormFilterInput(),
      'notedivers'        => new sfWidgetFormFilterInput(),
      'ribimpression'     => new sfWidgetFormFilterInput(),
      'typefournisseur'   => new sfWidgetFormFilterInput(),
      'certificatrs'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_dossier'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'id_banque'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'add_empty' => true)),
      'fax'               => new sfWidgetFormFilterInput(),
	   'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_updated'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur_10'), 'add_empty' => true)),
   
    ));

    $this->setValidators(array(
      'reference'         => new sfValidatorPass(array('required' => false)),
      'nom'               => new sfValidatorPass(array('required' => false)),
      'prenom'            => new sfValidatorPass(array('required' => false)),
      'rs'                => new sfValidatorPass(array('required' => false)),
      'mail'              => new sfValidatorPass(array('required' => false)),
      'tel'               => new sfValidatorPass(array('required' => false)),
      'gsm'               => new sfValidatorPass(array('required' => false)),
      'id_activite'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Activitetiers'), 'column' => 'id')),
      'nfiche'            => new sfValidatorPass(array('required' => false)),
      'id_user'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
     'datecreation'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'codefrs'           => new sfValidatorPass(array('required' => false)),
      'adr'               => new sfValidatorPass(array('required' => false)),
      'id_gouv'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
      'id_famillearticle' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Familleartfrs'), 'column' => 'id')),
      'observation'       => new sfValidatorPass(array('required' => false)),
      'compteg'           => new sfValidatorPass(array('required' => false)),
      'comptean'          => new sfValidatorPass(array('required' => false)),
      'assujtva'          => new sfValidatorPass(array('required' => false)),
      'fodec'             => new sfValidatorPass(array('required' => false)),
      'id_adresse'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
      'id_plancomptable'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'rib'               => new sfValidatorPass(array('required' => false)),
      'id_naturecompte'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id')),
      'matriculefiscale'  => new sfValidatorPass(array('required' => false)),
      'datemisajour'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'etatfrs'           => new sfValidatorPass(array('required' => false)),
      'valeurfodec'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notecloture'       => new sfValidatorPass(array('required' => false)),
      'noteoverture'      => new sfValidatorPass(array('required' => false)),
      'notedivers'        => new sfValidatorPass(array('required' => false)),
      'ribimpression'     => new sfValidatorPass(array('required' => false)),
      'typefournisseur'   => new sfValidatorPass(array('required' => false)),
      'certificatrs'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_dossier'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'id_banque'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Banque'), 'column' => 'id')),
      'fax'               => new sfValidatorPass(array('required' => false)),
	  'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'user_updated'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur_10'), 'column' => 'id')),
   
    ));

    $this->widgetSchema->setNameFormat('fournisseur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'reference'         => 'Text',
      'nom'               => 'Text',
      'prenom'            => 'Text',
      'rs'                => 'Text',
      'mail'              => 'Text',
      'tel'               => 'Text',
      'gsm'               => 'Text',
      'id_activite'       => 'ForeignKey',
      'nfiche'            => 'Text',
      'id_user'           => 'ForeignKey',
      'datecreation'      => 'Date',
      'codefrs'           => 'Text',
      'adr'               => 'Text',
      'id_gouv'           => 'ForeignKey',
      'id_famillearticle' => 'ForeignKey',
      'observation'       => 'Text',
      'compteg'           => 'Text',
      'comptean'          => 'Text',
      'assujtva'          => 'Text',
      'fodec'             => 'Text',
      'id_adresse'        => 'ForeignKey',
      'id_plancomptable'  => 'ForeignKey',
      'rib'               => 'Text',
      'id_naturecompte'   => 'ForeignKey',
      'matriculefiscale'  => 'Text',
      'datemisajour'      => 'Date',
      'etatfrs'           => 'Text',
      'valeurfodec'       => 'Number',
      'notecloture'       => 'Text',
      'noteoverture'      => 'Text',
      'notedivers'        => 'Text',
      'ribimpression'     => 'Text',
      'typefournisseur'   => 'Text',
      'certificatrs'      => 'Boolean',
      'id_dossier'        => 'ForeignKey',
      'id_banque'         => 'ForeignKey',
      'fax'               => 'Text',
    );
  }
}
