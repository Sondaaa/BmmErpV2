<?php

/**
 * Sourcesfinancemment filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSourcesfinancemmentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sourcefinancement' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sourcefinancement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sourcesfinancemment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sourcesfinancemment';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'sourcefinancement' => 'Text',
    );
  }
}
