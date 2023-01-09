<?php

/**
 * Objectdocument filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseObjectdocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'         => new sfWidgetFormFilterInput(),
      'numeroobject'    => new sfWidgetFormFilterInput(),
      'marqueobject'    => new sfWidgetFormFilterInput(),
      'dateentreeobjet' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'numeroobject'    => new sfValidatorPass(array('required' => false)),
      'marqueobject'    => new sfValidatorPass(array('required' => false)),
      'dateentreeobjet' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('objectdocument_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Objectdocument';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'libelle'         => 'Text',
      'numeroobject'    => 'Text',
      'marqueobject'    => 'Text',
      'dateentreeobjet' => 'Date',
    );
  }
}
