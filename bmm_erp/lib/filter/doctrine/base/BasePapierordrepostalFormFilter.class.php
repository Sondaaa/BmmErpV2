<?php

/**
 * Papierordrepostal filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePapierordrepostalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'repapier'      => new sfWidgetFormFilterInput(),
      'mnt'           => new sfWidgetFormFilterInput(),
      'datesignature' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cible'         => new sfWidgetFormFilterInput(),
      'objet'         => new sfWidgetFormFilterInput(),
      'etat'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'annule'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_carnet'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetordrepostal'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'repapier'      => new sfValidatorPass(array('required' => false)),
      'mnt'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'datesignature' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cible'         => new sfValidatorPass(array('required' => false)),
      'objet'         => new sfValidatorPass(array('required' => false)),
      'etat'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'annule'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_carnet'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Carnetordrepostal'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('papierordrepostal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Papierordrepostal';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'repapier'      => 'Text',
      'mnt'           => 'Number',
      'datesignature' => 'Date',
      'cible'         => 'Text',
      'objet'         => 'Text',
      'etat'          => 'Boolean',
      'annule'        => 'Boolean',
      'id_carnet'     => 'ForeignKey',
    );
  }
}
