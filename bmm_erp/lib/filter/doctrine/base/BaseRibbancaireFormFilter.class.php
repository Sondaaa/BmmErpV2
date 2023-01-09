<?php

/**
 * Ribbancaire filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseRibbancaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'rib'             => new sfWidgetFormFilterInput(),
      'etat'            => new sfWidgetFormFilterInput(),
      'banque_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banque'), 'add_empty' => true)),
      'naturebanque_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'frs_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'rib'             => new sfValidatorPass(array('required' => false)),
      'etat'            => new sfValidatorPass(array('required' => false)),
      'banque_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Banque'), 'column' => 'id')),
      'naturebanque_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id')),
      'frs_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ribbancaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ribbancaire';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'rib'             => 'Text',
      'etat'            => 'Text',
      'banque_id'       => 'ForeignKey',
      'naturebanque_id' => 'ForeignKey',
      'frs_id'          => 'ForeignKey',
    );
  }
}
