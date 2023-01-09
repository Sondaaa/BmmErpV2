<?php

/**
 * Lignemaquette filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignemaquetteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'               => new sfWidgetFormFilterInput(),
      'obligatoirecompte'    => new sfWidgetFormFilterInput(),
      'obligatoiremontant'   => new sfWidgetFormFilterInput(),
      'obligatoirecontre'    => new sfWidgetFormFilterInput(),
      'specificationcompte'  => new sfWidgetFormFilterInput(),
      'specificationmontant' => new sfWidgetFormFilterInput(),
      'specificationcontre'  => new sfWidgetFormFilterInput(),
      'montant'              => new sfWidgetFormFilterInput(),
      'numerolignemontant'   => new sfWidgetFormFilterInput(),
      'taux'                 => new sfWidgetFormFilterInput(),
      'type'                 => new sfWidgetFormFilterInput(),
      'id_maquette'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Maquette'), 'add_empty' => true)),
      'id_comptecomptable'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_contrepartie'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'add_empty' => true)),
      'tiers'                => new sfWidgetFormFilterInput(),
      'compteretenue'        => new sfWidgetFormFilterInput(),
      'id_compteretenue'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_4'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'obligatoirecompte'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'obligatoiremontant'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'obligatoirecontre'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'specificationcompte'  => new sfValidatorPass(array('required' => false)),
      'specificationmontant' => new sfValidatorPass(array('required' => false)),
      'specificationcontre'  => new sfValidatorPass(array('required' => false)),
      'montant'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numerolignemontant'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'taux'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'type'                 => new sfValidatorPass(array('required' => false)),
      'id_maquette'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Maquette'), 'column' => 'id')),
      'id_comptecomptable'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'id_contrepartie'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable_3'), 'column' => 'id')),
      'tiers'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'compteretenue'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_compteretenue'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable_4'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignemaquette_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemaquette';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'numero'               => 'Number',
      'obligatoirecompte'    => 'Number',
      'obligatoiremontant'   => 'Number',
      'obligatoirecontre'    => 'Number',
      'specificationcompte'  => 'Text',
      'specificationmontant' => 'Text',
      'specificationcontre'  => 'Text',
      'montant'              => 'Number',
      'numerolignemontant'   => 'Number',
      'taux'                 => 'Number',
      'type'                 => 'Text',
      'id_maquette'          => 'ForeignKey',
      'id_comptecomptable'   => 'ForeignKey',
      'id_contrepartie'      => 'ForeignKey',
      'tiers'                => 'Number',
      'compteretenue'        => 'Number',
      'id_compteretenue'     => 'ForeignKey',
    );
  }
}
