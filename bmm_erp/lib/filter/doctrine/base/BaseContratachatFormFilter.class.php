<?php

/**
 * Contratachat filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContratachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'             => new sfWidgetFormFilterInput(),
      'observation'           => new sfWidgetFormFilterInput(),
      'chemindoc'             => new sfWidgetFormFilterInput(),
      'id_demandeur'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
      'id_typedoc'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
      'id_adresse'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'id_lignedirectionsite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'designtaion'           => new sfWidgetFormFilterInput(),
      'id_objet'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objetreglement'), 'add_empty' => true)),
      'id_projet'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'mht'                   => new sfWidgetFormFilterInput(),
      'mnttva'                => new sfWidgetFormFilterInput(),
      'mnttc'                 => new sfWidgetFormFilterInput(),
      'etatdocachat'          => new sfWidgetFormFilterInput(),
      'id_user'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_frs'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_lieu'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieulivraisson'), 'add_empty' => true)),
      'montantcontrat'        => new sfWidgetFormFilterInput(),
      'id_etatdoc'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'add_empty' => true)),
      'datecreation'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datesigntaure'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_doc'                => new sfWidgetFormFilterInput(),
      'id_tauxfodec'          => new sfWidgetFormFilterInput(),
      'type'                  => new sfWidgetFormFilterInput(),
      'id_docparent'          => new sfWidgetFormFilterInput(),
      'montantplanfonne'      => new sfWidgetFormFilterInput(),
      'consulte'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'numero'                => new sfWidgetFormFilterInput(),
      'montantavenant'        => new sfWidgetFormFilterInput(),
	  'retenuegaraentie'      => new sfWidgetFormFilterInput(),
      'cautionement'          => new sfWidgetFormFilterInput(),
      'avance'                => new sfWidgetFormFilterInput(),
      'penalite'              => new sfWidgetFormFilterInput(),
      'datecommencement'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'maxpinalite'           => new sfWidgetFormFilterInput(),
	  'dateoservice'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datereceptionprevesoire' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'delaidexucution'         => new sfWidgetFormFilterInput(),
      'periodejustifier'        => new sfWidgetFormFilterInput(),
      'delaicontractuelle'      => new sfWidgetFormFilterInput(),
      'pireodereelexecution'    => new sfWidgetFormFilterInput(),
      'pirioderetard'           => new sfWidgetFormFilterInput(),
      'anciendateios'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    'delaicontratcuel'        => new sfWidgetFormFilterInput(),
      'typepaiment'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'reference'             => new sfValidatorPass(array('required' => false)),
      'observation'           => new sfValidatorPass(array('required' => false)),
      'chemindoc'             => new sfValidatorPass(array('required' => false)),
      'id_demandeur'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandeur'), 'column' => 'id')),
      'id_typedoc'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typedoc'), 'column' => 'id')),
      'id_adresse'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
      'id_lignedirectionsite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
      'designtaion'           => new sfValidatorPass(array('required' => false)),
      'id_objet'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Objetreglement'), 'column' => 'id')),
      'id_projet'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
      'mht'                   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttva'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttc'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'etatdocachat'          => new sfValidatorPass(array('required' => false)),
      'id_user'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_frs'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'id_lieu'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieulivraisson'), 'column' => 'id')),
      'montantcontrat'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_etatdoc'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etatdocument'), 'column' => 'id')),
      'datecreation'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datesigntaure'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_doc'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tauxfodec'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'                  => new sfValidatorPass(array('required' => false)),
      'id_docparent'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantplanfonne'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'consulte'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'numero'                => new sfValidatorPass(array('required' => false)),
      'montantavenant'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  'retenuegaraentie'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cautionement'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'avance'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'penalite'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'datecommencement'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'maxpinalite'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   'dateoservice'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datereceptionprevesoire' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'delaidexucution'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'periodejustifier'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'delaicontractuelle'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pireodereelexecution'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pirioderetard'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anciendateios'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
   'delaicontratcuel'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typepaiment'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contratachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contratachat';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'reference'             => 'Text',
      'observation'           => 'Text',
      'chemindoc'             => 'Text',
      'id_demandeur'          => 'ForeignKey',
      'id_typedoc'            => 'ForeignKey',
      'id_adresse'            => 'ForeignKey',
      'id_lignedirectionsite' => 'ForeignKey',
      'designtaion'           => 'Text',
      'id_objet'              => 'ForeignKey',
      'id_projet'             => 'ForeignKey',
      'mht'                   => 'Number',
      'mnttva'                => 'Number',
      'mnttc'                 => 'Number',
      'etatdocachat'          => 'Text',
      'id_user'               => 'ForeignKey',
      'id_frs'                => 'ForeignKey',
      'id_lieu'               => 'ForeignKey',
      'montantcontrat'        => 'Number',
      'id_etatdoc'            => 'ForeignKey',
      'datecreation'          => 'Date',
      'datesigntaure'         => 'Date',
      'id_doc'                => 'Number',
      'id_tauxfodec'          => 'Number',
      'type'                  => 'Text',
      'id_docparent'          => 'Number',
      'montantplanfonne'      => 'Number',
      'consulte'              => 'Boolean',
      'numero'                => 'Text',
      'montantavenant'        => 'Number',
    );
  }
}
