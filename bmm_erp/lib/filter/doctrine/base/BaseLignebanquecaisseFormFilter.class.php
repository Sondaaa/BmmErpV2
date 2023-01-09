<?php

/**
 * Lignebanquecaisse filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignebanquecaisseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
      
    $this->setWidgets(array(
      'id_caissebanque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'id_budget'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_caissebanque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
      'id_budget'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignebanquecaisse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignebanquecaisse';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_caissebanque' => 'ForeignKey',
      'id_budget'       => 'ForeignKey',
    );
  }
}
