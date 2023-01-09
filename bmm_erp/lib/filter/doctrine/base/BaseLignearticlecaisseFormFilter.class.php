<?php

/**
 * Lignearticlecaisse filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignearticlecaisseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ligneoperationcaisse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligneoperationcaisse'), 'add_empty' => true)),
      'id_lignearticle'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_ligneoperationcaisse' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligneoperationcaisse'), 'column' => 'id')),
      'id_lignearticle'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignedocachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignearticlecaisse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignearticlecaisse';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'id_ligneoperationcaisse' => 'ForeignKey',
      'id_lignearticle'         => 'ForeignKey',
    );
  }
}
