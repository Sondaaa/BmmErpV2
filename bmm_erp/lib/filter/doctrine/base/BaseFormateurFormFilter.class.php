<?php

/**
 * Formateur filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFormateurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cin'    => new sfWidgetFormFilterInput(),
      'nom'    => new sfWidgetFormFilterInput(),
      'prenom' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cin'    => new sfValidatorPass(array('required' => false)),
      'nom'    => new sfValidatorPass(array('required' => false)),
      'prenom' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('formateur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Formateur';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'cin'    => 'Text',
      'nom'    => 'Text',
      'prenom' => 'Text',
    );
  }
}
