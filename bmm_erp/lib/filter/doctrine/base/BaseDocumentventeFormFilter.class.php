<?php

/**
 * Documentvente filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentventeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'    => new sfWidgetFormFilterInput(),
      'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_client'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'reference'    => new sfValidatorPass(array('required' => false)),
      'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_client'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('documentvente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentvente';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'reference'    => 'Text',
      'datecreation' => 'Date',
      'id_client'    => 'ForeignKey',
    );
  }
}
