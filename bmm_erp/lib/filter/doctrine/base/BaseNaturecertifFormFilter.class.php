<?php

/**
 * Naturecertif filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaturecertifFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'        => new sfWidgetFormFilterInput(),
      'nbrjour'        => new sfWidgetFormFilterInput(),
      'typetraitement' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'nbrjour'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typetraitement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naturecertif_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naturecertif';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'libelle'        => 'Text',
      'nbrjour'        => 'Text',
      'typetraitement' => 'Text',
    );
  }
}
