<?php

/**
 * Fraisgeneraux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFraisgenerauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'annee'          => new sfWidgetFormFilterInput(),
      'date'           =>  new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'montantcharge'  => new sfWidgetFormFilterInput(),
      'montantproduit' => new sfWidgetFormFilterInput(),
      'montant'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'annee'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montantcharge'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'montantproduit' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'montant'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('fraisgeneraux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fraisgeneraux';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'annee'          => 'Number',
      'date'           => 'Date',
      'montantcharge'  => 'Number',
      'montantproduit' => 'Number',
      'montant'        => 'Number',
    );
  }
}
