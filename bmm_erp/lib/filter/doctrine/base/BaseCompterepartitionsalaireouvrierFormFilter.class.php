<?php

/**
 * Compterepartitionsalaireouvrier filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCompterepartitionsalaireouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_repartition'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'add_empty' => true)),
      'id_comptecomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_repartition'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repartitionsalaireouvrier'), 'column' => 'id')),
      'id_comptecomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('compterepartitionsalaireouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compterepartitionsalaireouvrier';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_repartition'     => 'ForeignKey',
      'id_comptecomptable' => 'ForeignKey',
    );
  }
}
