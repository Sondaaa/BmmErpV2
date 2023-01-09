<?php

/**
 * Ordredeservicecontratachat filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrdredeservicecontratachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'   => new sfWidgetFormFilterInput(),
      'object'      => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'id_type'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'add_empty' => true)),
      'dateios'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_contrat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'id_docachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'delaios'     => new sfWidgetFormFilterInput(),
      'id_frs'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'reference'   => new sfValidatorPass(array('required' => false)),
      'object'      => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'id_type'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeios'), 'column' => 'id')),
      'dateios'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_contrat'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratachat'), 'column' => 'id')),
      'id_docachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'delaios'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_frs'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ordredeservicecontratachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ordredeservicecontratachat';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'reference'   => 'Text',
      'object'      => 'Text',
      'description' => 'Text',
      'id_type'     => 'ForeignKey',
      'dateios'     => 'Date',
      'id_contrat'  => 'ForeignKey',
      'id_docachat' => 'ForeignKey',
      'delaios'     => 'Number',
      'id_frs'      => 'ForeignKey',
    );
  }
}
