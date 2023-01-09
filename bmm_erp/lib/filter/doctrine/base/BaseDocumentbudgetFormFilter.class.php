<?php

/**
 * Documentbudget filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentbudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'       => new sfWidgetFormFilterInput(),
      'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'id_type'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedocbudget'), 'add_empty' => true)),
      'id_budget'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mnt'          => new sfWidgetFormFilterInput(),
      'mntengage'    => new sfWidgetFormFilterInput(),
      'mntrelicat'   => new sfWidgetFormFilterInput(),
	  'annule'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
	  'mntresteresilier'  => new sfWidgetFormFilterInput(),
      'mntconsomme'       => new sfWidgetFormFilterInput(),
	   'description'       => new sfWidgetFormFilterInput(),
        ));

    $this->setValidators(array(
      'numero'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_type'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typedocbudget'), 'column' => 'id')),
      'id_budget'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'mnt'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntengage'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntrelicat'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  'annule'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mntresteresilier'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntconsomme'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   'description'       => new sfValidatorPass(array('required' => false)),
   
        ));

    $this->widgetSchema->setNameFormat('documentbudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentbudget';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'numero'       => 'Number',
      'datecreation' => 'Date',
      'id_type'      => 'ForeignKey',
      'id_budget'    => 'ForeignKey',
      'mnt'          => 'Number',
      'mntengage'    => 'Number',
      'mntrelicat'   => 'Number',
	  'annule'            => 'Boolean',
    );
  }
}
