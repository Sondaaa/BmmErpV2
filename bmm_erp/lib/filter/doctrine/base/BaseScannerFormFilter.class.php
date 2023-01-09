<?php

/**
 * Scanner filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseScannerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'chaine' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'chaine' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('scanner_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Scanner';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'chaine' => 'Text',
    );
  }
}
