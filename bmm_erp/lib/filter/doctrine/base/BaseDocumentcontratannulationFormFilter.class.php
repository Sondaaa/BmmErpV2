<?php

/**
 * Documentcontratannulation filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentcontratannulationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dateannulation'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_user'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'motifannulation' => new sfWidgetFormFilterInput(),
      'urldocscaner'    => new sfWidgetFormFilterInput(),
      'valide_budget'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_docachat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_doccontrat'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'dateannulation'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_user'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'motifannulation' => new sfValidatorPass(array('required' => false)),
      'urldocscaner'    => new sfValidatorPass(array('required' => false)),
      'valide_budget'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_docachat'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'id_doccontrat'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('documentcontratannulation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentcontratannulation';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'dateannulation'  => 'Date',
      'id_user'         => 'ForeignKey',
      'motifannulation' => 'Text',
      'urldocscaner'    => 'Text',
      'valide_budget'   => 'Boolean',
      'id_docachat'     => 'ForeignKey',
      'id_doccontrat'   => 'ForeignKey',
    );
  }
}
