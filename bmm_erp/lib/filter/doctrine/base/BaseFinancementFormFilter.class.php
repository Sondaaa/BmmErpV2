<?php

/**
 * Financement filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFinancementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mntht'               => new sfWidgetFormFilterInput(),
      'tauxtva'             => new sfWidgetFormFilterInput(),
      'mntttc'              => new sfWidgetFormFilterInput(),
      'mnttva'              => new sfWidgetFormFilterInput(),
      'caracteristiqueprix' => new sfWidgetFormFilterInput(),
      'natureprix'          => new sfWidgetFormFilterInput(),
      'id_lignebudget'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_marche'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),
      'id_tva'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'mntht'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tauxtva'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntttc'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttva'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'caracteristiqueprix' => new sfValidatorPass(array('required' => false)),
      'natureprix'          => new sfValidatorPass(array('required' => false)),
      'id_lignebudget'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'id_marche'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Marches'), 'column' => 'id')),
      'id_tva'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('financement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Financement';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'mntht'               => 'Number',
      'tauxtva'             => 'Number',
      'mntttc'              => 'Number',
      'mnttva'              => 'Number',
      'caracteristiqueprix' => 'Text',
      'natureprix'          => 'Text',
      'id_lignebudget'      => 'ForeignKey',
      'id_marche'           => 'ForeignKey',
      'id_tva'              => 'ForeignKey',
    );
  }
}
