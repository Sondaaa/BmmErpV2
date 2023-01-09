<?php

/**
 * Etatdocument filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtatdocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etatdocachat' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'etatdocachat' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('etatdocument_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etatdocument';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'etatdocachat' => 'Text',
    );
  }
}
