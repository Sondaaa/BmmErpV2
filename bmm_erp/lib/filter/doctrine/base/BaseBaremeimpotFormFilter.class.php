<?php

/**
 * Baremeimpot filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBaremeimpotFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'montantdebut' => new sfWidgetFormFilterInput(),
      'montantfin'   => new sfWidgetFormFilterInput(),
      'pourcentage'  => new sfWidgetFormFilterInput(),
      'libelle'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'montantdebut' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'montantfin'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'pourcentage'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'libelle'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('baremeimpot_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Baremeimpot';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'montantdebut' => 'Number',
      'montantfin'   => 'Number',
      'pourcentage'  => 'Number',
      'libelle'      => 'Text',
    );
  }
}
