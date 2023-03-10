<?php

/**
 * Typefamille filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypefamilleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'    => new sfWidgetFormFilterInput(),
      'libelle' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'libelle' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typefamille_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typefamille';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'code'    => 'Number',
      'libelle' => 'Text',
    );
  }
}
