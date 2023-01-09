<?php

/**
 * Travailrapporttravaux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTravailrapporttravauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'           => new sfWidgetFormFilterInput(),
      'montant'           => new sfWidgetFormFilterInput(),
      'id_rapporttravaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'           => new sfValidatorPass(array('required' => false)),
      'montant'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_rapporttravaux' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rapporttravaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('travailrapporttravaux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Travailrapporttravaux';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'libelle'           => 'Text',
      'montant'           => 'Number',
      'id_rapporttravaux' => 'ForeignKey',
    );
  }
}
