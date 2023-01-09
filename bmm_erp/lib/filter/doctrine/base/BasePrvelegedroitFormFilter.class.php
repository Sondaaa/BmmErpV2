<?php

/**
 * Prvelegedroit filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePrvelegedroitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_role'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => true)),
      'id_prevelege' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prevelege'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_role'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Role'), 'column' => 'id')),
      'id_prevelege' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Prevelege'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('prvelegedroit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prvelegedroit';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_role'      => 'ForeignKey',
      'id_prevelege' => 'ForeignKey',
    );
  }
}
