<?php

/**
 * Annexebudget filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnnexebudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titre'        => new sfWidgetFormFilterInput(),
      'nbrcolonne'   => new sfWidgetFormFilterInput(),
      'direction'    => new sfWidgetFormFilterInput(),
      'sommation'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'titre'        => new sfValidatorPass(array('required' => false)),
      'nbrcolonne'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'direction'    => new sfValidatorPass(array('required' => false)),
      'sommation'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('annexebudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annexebudget';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'titre'        => 'Text',
      'nbrcolonne'   => 'Number',
      'direction'    => 'Text',
      'sommation'    => 'Boolean',
      'datecreation' => 'Date',
    );
  }
}
