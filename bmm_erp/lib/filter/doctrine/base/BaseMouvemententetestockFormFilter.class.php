<?php

/**
 * Mouvemententetestock filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMouvemententetestockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'exercice' => new sfWidgetFormFilterInput(),
      'libelle'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exercice' => new sfValidatorPass(array('required' => false)),
      'libelle'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mouvemententetestock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mouvemententetestock';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'exercice' => 'Text',
      'libelle'  => 'Text',
    );
  }
}
