<?php

/**
 * Compte filter form base class.
 *
 * @package    Inventairetest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCompteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comptecomptable' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'comptecomptable' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('compte_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compte';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'comptecomptable' => 'Text',
    );
  }
}
