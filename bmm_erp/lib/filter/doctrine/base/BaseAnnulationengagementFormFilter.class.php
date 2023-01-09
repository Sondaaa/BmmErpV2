<?php

/**
 * Annulationengagement filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnnulationengagementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'montantecart'                 => new sfWidgetFormFilterInput(),
      'totale'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_lignemouvementfacturation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'add_empty' => true)),
      'id_ligprotitrub'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_documentachat'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montantecart'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totale'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_lignemouvementfacturation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'column' => 'id')),
      'id_ligprotitrub'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'id_documentachat'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('annulationengagement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annulationengagement';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'date'                         => 'Date',
      'montantecart'                 => 'Number',
      'totale'                       => 'Boolean',
      'id_lignemouvementfacturation' => 'ForeignKey',
      'id_ligprotitrub'              => 'ForeignKey',
      'id_documentachat'             => 'ForeignKey',
    );
  }
}
