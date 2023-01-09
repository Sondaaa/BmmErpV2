<?php

/**
 * Fabricant filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFabricantFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fabricant' => new sfWidgetFormFilterInput(),
      'reference' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fabricant' => new sfValidatorPass(array('required' => false)),
      'reference' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fabricant_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fabricant';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'fabricant' => 'Text',
      'reference' => 'Text',
    );
  }
}
