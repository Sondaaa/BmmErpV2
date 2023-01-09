<?php

/**
 * Tauxammortisement filter form base class.
 *
 * @package    Inventairetest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTauxammortisementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tauxammortisement' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tauxammortisement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tauxammortisement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tauxammortisement';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'tauxammortisement' => 'Text',
    );
  }
}
