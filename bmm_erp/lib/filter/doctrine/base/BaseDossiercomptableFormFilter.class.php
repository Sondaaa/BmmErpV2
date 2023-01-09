<?php

/**
 * Dossiercomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDossiercomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'                      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'code'                      => new sfWidgetFormFilterInput(),
      'raisonsociale'             => new sfWidgetFormFilterInput(),
      'telephoneun'               => new sfWidgetFormFilterInput(),
      'telephonedeux'             => new sfWidgetFormFilterInput(),
      'fax'                       => new sfWidgetFormFilterInput(),
      'email'                     => new sfWidgetFormFilterInput(),
      'matriculefiscale'          => new sfWidgetFormFilterInput(),
      'registrecommerce'          => new sfWidgetFormFilterInput(),
      'datedebutouverture'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datecloture'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nombrechiffrenumerocompte' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombrechiffreapresvirgule' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datecreationentreprise'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinouverture'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_devise'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_formejuridique'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formejuridique'), 'add_empty' => true)),
      'id_adresse'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'id_secteuractivite'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteuractivite'), 'add_empty' => true)),
      'id_activite'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'add_empty' => true)),
      'id_user'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_compteattente'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_comptevente'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_8'), 'add_empty' => true)),
      'id_compteachat'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_9'), 'add_empty' => true)),
      'archive'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_exercice'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
	   'tauxfoprolos'              => new sfWidgetFormFilterInput(),
      'id_typeregime'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'dateentreenproduction'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinavantage'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nbravantage'               => new sfWidgetFormFilterInput(),
      'calculheuresupp'           => new sfWidgetFormFilterInput(),
      'qualificationcnss'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'situationprofess'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dateembauche'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rib'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'soldeconge'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'periode'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mntlibelleprime'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'lignessp'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'editgrille'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'reparation'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'controlerevenue'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'journalpaie'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'assurancejouralpaie'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
	    'tfp'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'foprolos'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_contribution'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
  'tauxaccidentcotisation'    => new sfWidgetFormFilterInput(),
  'id_lignecontribition'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'add_empty' => true)),   
   ));

    $this->setValidators(array(
      'date'                      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'code'                      => new sfValidatorPass(array('required' => false)),
      'raisonsociale'             => new sfValidatorPass(array('required' => false)),
      'telephoneun'               => new sfValidatorPass(array('required' => false)),
      'telephonedeux'             => new sfValidatorPass(array('required' => false)),
      'fax'                       => new sfValidatorPass(array('required' => false)),
      'email'                     => new sfValidatorPass(array('required' => false)),
      'matriculefiscale'          => new sfValidatorPass(array('required' => false)),
      'registrecommerce'          => new sfValidatorPass(array('required' => false)),
      'datedebutouverture'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datecloture'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nombrechiffrenumerocompte' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombrechiffreapresvirgule' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datecreationentreprise'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinouverture'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_devise'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'id_formejuridique'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formejuridique'), 'column' => 'id')),
      'id_adresse'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
      'id_secteuractivite'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteuractivite'), 'column' => 'id')),
      'id_activite'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Activitetiers'), 'column' => 'id')),
      'id_user'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_compteattente'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'id_comptevente'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable_8'), 'column' => 'id')),
      'id_compteachat'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable_9'), 'column' => 'id')),
      'archive'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_exercice'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Exercice'), 'column' => 'id')),
	   'tauxtfp'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tauxfoprolos'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_typeregime'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id')),
      'dateentreenproduction'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinavantage'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nbravantage'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'calculheuresupp'           => new sfValidatorPass(array('required' => false)),
      'qualificationcnss'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'situationprofess'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dateembauche'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rib'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'soldeconge'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'periode'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mntlibelleprime'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'lignessp'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'editgrille'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'reparation'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'controlerevenue'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'journalpaie'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'assurancejouralpaie'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
	  'tfp'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'foprolos'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_contribution'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id')),
     'tauxaccidentcotisation'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
        'id_lignecontribition'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignecontribitionsociale'), 'column' => 'id')),
	));

    $this->widgetSchema->setNameFormat('dossiercomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dossiercomptable';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'date'                      => 'Date',
      'code'                      => 'Text',
      'raisonsociale'             => 'Text',
      'telephoneun'               => 'Text',
      'telephonedeux'             => 'Text',
      'fax'                       => 'Text',
      'email'                     => 'Text',
      'matriculefiscale'          => 'Text',
      'registrecommerce'          => 'Text',
      'datedebutouverture'        => 'Date',
      'datecloture'               => 'Date',
      'nombrechiffrenumerocompte' => 'Number',
      'nombrechiffreapresvirgule' => 'Number',
      'datecreationentreprise'    => 'Date',
      'datefinouverture'          => 'Date',
      'id_devise'                 => 'ForeignKey',
      'id_formejuridique'         => 'ForeignKey',
      'id_adresse'                => 'ForeignKey',
      'id_secteuractivite'        => 'ForeignKey',
      'id_activite'               => 'ForeignKey',
      'id_user'                   => 'ForeignKey',
      'id_compteattente'          => 'ForeignKey',
      'id_comptevente'            => 'ForeignKey',
      'id_compteachat'            => 'ForeignKey',
      'archive'                   => 'Boolean',
      'id_exercice'               => 'ForeignKey',
	   'tfp'                       => 'Boolean',
      'foprolos'                  => 'Boolean',
      'id_contribution'           => 'ForeignKey',
    );
  }
}
