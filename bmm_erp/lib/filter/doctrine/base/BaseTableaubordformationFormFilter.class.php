<?php

/**
 * Tableaubordformation filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTableaubordformationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_plan'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'id_ristourne'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ristourne'), 'add_empty' => true)),
      'nbrjour'          => new sfWidgetFormFilterInput(),
      'nbrheure'         => new sfWidgetFormFilterInput(),
      'montantristourne' => new sfWidgetFormFilterInput(),
      'montantsociete'   => new sfWidgetFormFilterInput(),
      'tva'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_plan'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Planing'), 'column' => 'id')),
      'id_ristourne'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ristourne'), 'column' => 'id')),
      'nbrjour'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nbrheure'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantristourne' => new sfValidatorPass(array('required' => false)),
      'montantsociete'   => new sfValidatorPass(array('required' => false)),
      'tva'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tableaubordformation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tableaubordformation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_plan'          => 'ForeignKey',
      'id_ristourne'     => 'ForeignKey',
      'nbrjour'          => 'Number',
      'nbrheure'         => 'Number',
      'montantristourne' => 'Text',
      'montantsociete'   => 'Text',
      'tva'              => 'Text',
    );
  }
}
