<?php

/**
 * Lignesociete filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignesocieteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_societe'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'codemois'        => new sfWidgetFormFilterInput(),
      'libelle'         => new sfWidgetFormFilterInput(),
      'moiscalendiarle' => new sfWidgetFormFilterInput(),
      'nordre'          => new sfWidgetFormFilterInput(),
	   'annee'           => new sfWidgetFormFilterInput(),
      'nbrmois'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_societe'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Societe'), 'column' => 'id')),
      'codemois'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'moiscalendiarle' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nordre'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
	  'annee'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrmois'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignesociete_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignesociete';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_societe'      => 'ForeignKey',
      'codemois'        => 'Number',
      'libelle'         => 'Text',
      'moiscalendiarle' => 'Number',
      'nordre'          => 'Number',
    );
  }
}
