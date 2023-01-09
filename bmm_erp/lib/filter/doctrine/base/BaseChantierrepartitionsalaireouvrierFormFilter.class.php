<?php

/**
 * Chantierrepartitionsalaireouvrier filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseChantierrepartitionsalaireouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_repartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'add_empty' => true)),
      'libelle'        => new sfWidgetFormFilterInput(),
      'montant'        => new sfWidgetFormFilterInput(),
      'id_projet'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'jour'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_repartition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'column' => 'id')),
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'montant'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_projet'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
      'jour'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('chantierrepartitionsalaireouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Chantierrepartitionsalaireouvrier';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_repartition' => 'ForeignKey',
      'libelle'        => 'Text',
      'montant'        => 'Number',
      'id_projet'      => 'ForeignKey',
      'jour'           => 'Number',
    );
  }
}
