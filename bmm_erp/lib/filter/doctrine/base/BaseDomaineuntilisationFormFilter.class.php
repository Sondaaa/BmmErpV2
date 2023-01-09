<?php

/**
 * Domaineuntilisation filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDomaineuntilisationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle' => new sfWidgetFormFilterInput(),
      'code'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle' => new sfValidatorPass(array('required' => false)),
      'code'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('domaineuntilisation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Domaineuntilisation';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'libelle' => 'Text',
      'code'    => 'Number',
    );
  }
}
