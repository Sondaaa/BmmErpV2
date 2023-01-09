<?php

/**
 * Papiercheque filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePapierchequeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_carnet'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetcheque'), 'add_empty' => true)),
      'refpapier'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mntcheque'     => new sfWidgetFormFilterInput(),
      'datesignature' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'cible'         => new sfWidgetFormFilterInput(),
      'etat'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'annule'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_carnet'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carnetcheque'), 'column' => 'id')),
      'refpapier'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntcheque'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'datesignature' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cible'         => new sfValidatorPass(array('required' => false)),
      'etat'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'annule'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('papiercheque_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Papiercheque';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_carnet'     => 'ForeignKey',
      'refpapier'     => 'Number',
      'mntcheque'     => 'Number',
      'datesignature' => 'Date',
      'cible'         => 'Text',
      'etat'          => 'Boolean',
      'annule'        => 'Boolean',
    );
  }
}
