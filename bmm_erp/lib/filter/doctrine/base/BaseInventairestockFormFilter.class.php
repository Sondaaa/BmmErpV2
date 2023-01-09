<?php

/**
 * Inventairestock filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInventairestockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datedepart'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'datefermeture' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'id_mag'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'numero'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'datedepart'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefermeture' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_mag'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
      'numero'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inventairestock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inventairestock';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'datedepart'    => 'Date',
      'datefermeture' => 'Date',
      'id_mag'        => 'ForeignKey',
      'numero'        => 'Text',
    );
  }
}
