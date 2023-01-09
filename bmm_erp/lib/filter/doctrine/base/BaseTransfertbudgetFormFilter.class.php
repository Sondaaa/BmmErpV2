<?php

/**
 * Transfertbudget filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTransfertbudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datecreation'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'id_source'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_destination'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub_2'), 'add_empty' => true)),
      'id_typetransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typetransfert'), 'add_empty' => true)),
      'objectif'         => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'mnttransfert'     => new sfWidgetFormFilterInput(),
      'sourcebudget'     => new sfWidgetFormFilterInput(),
	   'etattransfert'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'datecreation'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_source'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'id_destination'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub_2'), 'column' => 'id')),
      'id_typetransfert' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typetransfert'), 'column' => 'id')),
      'objectif'         => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'mnttransfert'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sourcebudget'     => new sfValidatorPass(array('required' => false)),
	   'etattransfert'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transfertbudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transfertbudget';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'datecreation'     => 'Date',
      'id_source'        => 'ForeignKey',
      'id_destination'   => 'ForeignKey',
      'id_typetransfert' => 'ForeignKey',
      'objectif'         => 'Text',
      'description'      => 'Text',
      'mnttransfert'     => 'Number',
      'sourcebudget'     => 'Text',
    );
  }
}
