<?php

/**
 * Gouvernera filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGouverneraFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gouvernera' => new sfWidgetFormFilterInput(),
      'id_pays'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'gouvernera' => new sfValidatorPass(array('required' => false)),
      'id_pays'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pays'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('gouvernera_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gouvernera';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'gouvernera' => 'Text',
      'id_pays'    => 'ForeignKey',
    );
  }
}
