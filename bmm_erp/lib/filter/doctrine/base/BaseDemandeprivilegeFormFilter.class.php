<?php

/**
 * Demandeprivilege filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeprivilegeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typedoc'        => new sfWidgetFormFilterInput(),
      'objet'          => new sfWidgetFormFilterInput(),
      'id_objet'       => new sfWidgetFormFilterInput(),
      'description'    => new sfWidgetFormFilterInput(),
      'id_userdemande' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'etat'           => new sfWidgetFormFilterInput(),
      'valide'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'datevalidation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'typedoc'        => new sfValidatorPass(array('required' => false)),
      'objet'          => new sfValidatorPass(array('required' => false)),
      'id_objet'       => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
      'id_userdemande' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'etat'           => new sfValidatorPass(array('required' => false)),
      'valide'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'datevalidation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('demandeprivilege_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandeprivilege';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'typedoc'        => 'Text',
      'objet'          => 'Text',
      'id_objet'       => 'Text',
      'description'    => 'Text',
      'id_userdemande' => 'ForeignKey',
      'etat'           => 'Text',
      'valide'         => 'Boolean',
      'datevalidation' => 'Date',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
