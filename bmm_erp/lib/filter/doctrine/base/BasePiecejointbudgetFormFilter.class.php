<?php

/**
 * Piecejointbudget filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePiecejointbudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'         => new sfWidgetFormFilterInput(),
      'id_docachat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_type'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typexpdes'), 'add_empty' => true)),
      'id_documentbudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
      'description'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'reference'         => new sfValidatorPass(array('required' => false)),
      'id_docachat'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'id_type'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typexpdes'), 'column' => 'id')),
      'id_documentbudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id')),
      'description'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('piecejointbudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Piecejointbudget';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'reference'         => 'Text',
      'id_docachat'       => 'ForeignKey',
      'id_type'           => 'ForeignKey',
      'id_documentbudget' => 'ForeignKey',
      'description'       => 'Text',
    );
  }
}
