<?php

/**
 * Lignedocumenttransfert filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseLignedocumenttransfertFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_immo'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'id_documenttransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documenttransfert'), 'add_empty' => true)),
      'id_local1'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
      'id_local2'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux_3'), 'add_empty' => true)),
      'id_curenttransfert'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Emplacement'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_immo'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Immobilisation'), 'column' => 'id')),
      'id_documenttransfert' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documenttransfert'), 'column' => 'id')),
      'id_local1'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
      'id_local2'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux_3'), 'column' => 'id')),
      'id_curenttransfert'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Emplacement'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignedocumenttransfert_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocumenttransfert';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_immo'              => 'ForeignKey',
      'id_documenttransfert' => 'ForeignKey',
      'id_local1'            => 'ForeignKey',
      'id_local2'            => 'ForeignKey',
      'id_curenttransfert'   => 'ForeignKey',
    );
  }
}
