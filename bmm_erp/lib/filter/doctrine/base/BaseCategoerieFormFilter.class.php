<?php

/**
 * Categoerie filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoerieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categorie'     => new sfWidgetFormFilterInput(),
      'codecategoeie' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'categorie'     => new sfValidatorPass(array('required' => false)),
      'codecategoeie' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categoerie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categoerie';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'categorie'     => 'Text',
      'codecategoeie' => 'Text',
    );
  }
}
