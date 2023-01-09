<?php

/**
 * Pvrception filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePvrceptionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datepvrecptionprovisoire' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'observation'              => new sfWidgetFormFilterInput(),
      'typepv'                   => new sfWidgetFormFilterInput(),
      'urldocumentscan'          => new sfWidgetFormFilterInput(),
      'piecejojnt'               => new sfWidgetFormFilterInput(),
      'datereceptiondef'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_lots'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
      'id_user'                  => new sfWidgetFormFilterInput(),
	   'reserve'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'datepvrecptionprovisoire' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'observation'              => new sfValidatorPass(array('required' => false)),
      'typepv'                   => new sfValidatorPass(array('required' => false)),
      'urldocumentscan'          => new sfValidatorPass(array('required' => false)),
      'piecejojnt'               => new sfValidatorPass(array('required' => false)),
      'datereceptiondef'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_lots'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lots'), 'column' => 'id')),
      'id_user'                  => new sfValidatorPass(array('required' => false)),
	   'reserve'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pvrception_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pvrception';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'datepvrecptionprovisoire' => 'Date',
      'observation'              => 'Text',
      'typepv'                   => 'Text',
      'urldocumentscan'          => 'Text',
      'piecejojnt'               => 'Text',
      'datereceptiondef'         => 'Date',
      'id_lots'                  => 'ForeignKey',
      'id_user'                  => 'Text',
    );
  }
}
