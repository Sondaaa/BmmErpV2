<?php

/**
 * Site filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSiteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site'       => new sfWidgetFormFilterInput(),
      'id_societe' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Societe'), 'add_empty' => true)),
      'id_adresse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'site'       => new sfValidatorPass(array('required' => false)),
      'id_societe' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Societe'), 'column' => 'id')),
      'id_adresse' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('site_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Site';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'site'       => 'Text',
      'id_societe' => 'ForeignKey',
      'id_adresse' => 'ForeignKey',
    );
  }
}
