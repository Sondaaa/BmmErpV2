<?php

/**
 * Reclamationfrs filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReclamationfrsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'object'  => new sfWidgetFormFilterInput(),
      'daterec' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'sujet'   => new sfWidgetFormFilterInput(),
      'id_frs'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'object'  => new sfValidatorPass(array('required' => false)),
      'daterec' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sujet'   => new sfValidatorPass(array('required' => false)),
      'id_frs'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('reclamationfrs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reclamationfrs';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'object'  => 'Text',
      'daterec' => 'Date',
      'sujet'   => 'Text',
      'id_frs'  => 'ForeignKey',
    );
  }
}
