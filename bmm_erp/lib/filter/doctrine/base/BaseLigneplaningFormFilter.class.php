<?php

/**
 * Ligneplaning filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneplaningFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nordre'           => new sfWidgetFormFilterInput(),
      'numtheme'         => new sfWidgetFormFilterInput(),
      'id_regroupement'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regroupementtheme'), 'add_empty' => true)),
      'id_sousrubrique'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'add_empty' => true)),
      'montant'          => new sfWidgetFormFilterInput(),
      'montanttotalht'   => new sfWidgetFormFilterInput(),
      'id_besoins'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'add_empty' => true)),
      'theme'            => new sfWidgetFormFilterInput(),
      'valide'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_pluning'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'montantttc'       => new sfWidgetFormFilterInput(),
      'dateformation'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montantht'        => new sfWidgetFormFilterInput(),
      'id_formateur'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'add_empty' => true)),
      'id_tva'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'mtva'             => new sfWidgetFormFilterInput(),
      'nbrjour'          => new sfWidgetFormFilterInput(),
      'nbrheure'         => new sfWidgetFormFilterInput(),
      'montantristourne' => new sfWidgetFormFilterInput(),
      'montantsociete'   => new sfWidgetFormFilterInput(),
      'mtvafinal'        => new sfWidgetFormFilterInput(),
      'modalitecalcul'   => new sfWidgetFormFilterInput(),
      'realise'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'motif'            => new sfWidgetFormFilterInput(),
      'datedebutprevu'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinprevu'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_fournisseur'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_facture'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nordre'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numtheme'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_regroupement'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regroupementtheme'), 'column' => 'id')),
      'id_sousrubrique'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousrubrique'), 'column' => 'id')),
      'montant'          => new sfValidatorPass(array('required' => false)),
      'montanttotalht'   => new sfValidatorPass(array('required' => false)),
      'id_besoins'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Besoinsdeformation'), 'column' => 'id')),
      'theme'            => new sfValidatorPass(array('required' => false)),
      'valide'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_pluning'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Planing'), 'column' => 'id')),
      'montantttc'       => new sfValidatorPass(array('required' => false)),
      'dateformation'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montantht'        => new sfValidatorPass(array('required' => false)),
      'id_formateur'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formateur'), 'column' => 'id')),
      'id_tva'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
      'mtva'             => new sfValidatorPass(array('required' => false)),
      'nbrjour'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrheure'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantristourne' => new sfValidatorPass(array('required' => false)),
      'montantsociete'   => new sfValidatorPass(array('required' => false)),
      'mtvafinal'        => new sfValidatorPass(array('required' => false)),
      'modalitecalcul'   => new sfValidatorPass(array('required' => false)),
      'realise'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'motif'            => new sfValidatorPass(array('required' => false)),
      'datedebutprevu'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinprevu'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_fournisseur'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'id_facture'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ligneplaning_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneplaning';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'nordre'           => 'Number',
      'numtheme'         => 'Number',
      'id_regroupement'  => 'ForeignKey',
      'id_sousrubrique'  => 'ForeignKey',
      'montant'          => 'Text',
      'montanttotalht'   => 'Text',
      'id_besoins'       => 'ForeignKey',
      'theme'            => 'Text',
      'valide'           => 'Boolean',
      'id_pluning'       => 'ForeignKey',
      'montantttc'       => 'Text',
      'dateformation'    => 'Date',
      'datefin'          => 'Date',
      'montantht'        => 'Text',
      'id_formateur'     => 'ForeignKey',
      'id_tva'           => 'ForeignKey',
      'mtva'             => 'Text',
      'nbrjour'          => 'Number',
      'nbrheure'         => 'Number',
      'montantristourne' => 'Text',
      'montantsociete'   => 'Text',
      'mtvafinal'        => 'Text',
      'modalitecalcul'   => 'Text',
      'realise'          => 'Boolean',
      'motif'            => 'Text',
      'datedebutprevu'   => 'Date',
      'datefinprevu'     => 'Date',
      'id_fournisseur'   => 'ForeignKey',
      'id_facture'       => 'ForeignKey',
    );
  }
}
