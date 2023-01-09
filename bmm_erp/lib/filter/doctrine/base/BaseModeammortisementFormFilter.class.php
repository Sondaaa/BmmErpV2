<?php

/**
 * Modeammortisement filter form base class.
 *
 * @package    Inventairetest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseModeammortisementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'modeammortisement' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'modeammortisement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modeammortisement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modeammortisement';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'modeammortisement' => 'Text',
    );
  }
}
