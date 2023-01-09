<?php

/**
 * Documentachatannulation filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentachatannulationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'dateannulation'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'motifannulation'  => new sfWidgetFormFilterInput(),
      'urldocumentscan'  => new sfWidgetFormFilterInput(),
      'valide_budget'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_documentachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'dateannulation'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_user'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'motifannulation'  => new sfValidatorPass(array('required' => false)),
      'urldocumentscan'  => new sfValidatorPass(array('required' => false)),
      'valide_budget'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('documentachatannulation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentachatannulation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_documentachat' => 'ForeignKey',
      'dateannulation'   => 'Date',
      'id_user'          => 'ForeignKey',
      'motifannulation'  => 'Text',
      'urldocumentscan'  => 'Text',
      'valide_budget'    => 'Boolean',
    );
  }
}