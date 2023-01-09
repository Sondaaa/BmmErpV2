<?php

/**
 * Niveauxage filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNiveauxageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'       => new sfWidgetFormFilterInput(),
      'intervaldebut' => new sfWidgetFormFilterInput(),
      'intervalfin'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'       => new sfValidatorPass(array('required' => false)),
      'intervaldebut' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'intervalfin'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('niveauxage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Niveauxage';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'libelle'       => 'Text',
      'intervaldebut' => 'Number',
      'intervalfin'   => 'Number',
    );
  }
}
