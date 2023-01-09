<?php

/**
 * Detailprix filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetailprixFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'totalgeneral'      => new sfWidgetFormFilterInput(),
      'rrr'               => new sfWidgetFormFilterInput(),
      'totalapresremise'  => new sfWidgetFormFilterInput(),
      'id_tva'            => new sfWidgetFormFilterInput(),
      'tauxtva'           => new sfWidgetFormFilterInput(),
      'mnttva'            => new sfWidgetFormFilterInput(),
      'retenuegarentie'   => new sfWidgetFormFilterInput(),
      'total'             => new sfWidgetFormFilterInput(),
      'deponseantirieur'  => new sfWidgetFormFilterInput(),
      'netapayer'         => new sfWidgetFormFilterInput(),
      'htva'              => new sfWidgetFormFilterInput(),
      'datecreation'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_lots'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
      'id_typedetailprix' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedetailprix'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'totalgeneral'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'rrr'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalapresremise'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_tva'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tauxtva'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttva'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'retenuegarentie'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'deponseantirieur'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'netapayer'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'htva'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'datecreation'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_lots'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lots'), 'column' => 'id')),
      'id_typedetailprix' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typedetailprix'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('detailprix_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Detailprix';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'totalgeneral'      => 'Number',
      'rrr'               => 'Number',
      'totalapresremise'  => 'Number',
      'id_tva'            => 'Number',
      'tauxtva'           => 'Number',
      'mnttva'            => 'Number',
      'retenuegarentie'   => 'Number',
      'total'             => 'Number',
      'deponseantirieur'  => 'Number',
      'netapayer'         => 'Number',
      'htva'              => 'Number',
      'datecreation'      => 'Date',
      'id_lots'           => 'ForeignKey',
      'id_typedetailprix' => 'ForeignKey',
    );
  }
}
