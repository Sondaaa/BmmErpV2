<?php

/**
 * Lignetravailrapport filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignetravailrapportFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'           => new sfWidgetFormFilterInput(),
      'montant'           => new sfWidgetFormFilterInput(),
      'id_travailrapport' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Travailrapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'           => new sfValidatorPass(array('required' => false)),
      'montant'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_travailrapport' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Travailrapporttravaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignetravailrapport_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetravailrapport';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'libelle'           => 'Text',
      'montant'           => 'Number',
      'id_travailrapport' => 'ForeignKey',
    );
  }
}
