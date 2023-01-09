<?php

/**
 * Affectaioncourrier filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAffectaioncourrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelleaffcetation' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelleaffcetation' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('affectaioncourrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Affectaioncourrier';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'libelleaffcetation' => 'Text',
    );
  }
}
