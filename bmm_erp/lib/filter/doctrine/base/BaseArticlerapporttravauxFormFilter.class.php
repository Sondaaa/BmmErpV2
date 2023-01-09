<?php

/**
 * Articlerapporttravaux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticlerapporttravauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mre'               => new sfWidgetFormFilterInput(),
      'dps'               => new sfWidgetFormFilterInput(),
      'maint'             => new sfWidgetFormFilterInput(),
      'bat'               => new sfWidgetFormFilterInput(),
      'plant'             => new sfWidgetFormFilterInput(),
      'montant'           => new sfWidgetFormFilterInput(),
      'id_immobilisation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'id_rapporttravaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'mre'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dps'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'maint'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'bat'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'plant'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'montant'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_immobilisation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Immobilisation'), 'column' => 'id')),
      'id_rapporttravaux' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rapporttravaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('articlerapporttravaux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articlerapporttravaux';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'mre'               => 'Number',
      'dps'               => 'Number',
      'maint'             => 'Number',
      'bat'               => 'Number',
      'plant'             => 'Number',
      'montant'           => 'Number',
      'id_immobilisation' => 'ForeignKey',
      'id_rapporttravaux' => 'ForeignKey',
    );
  }
}
