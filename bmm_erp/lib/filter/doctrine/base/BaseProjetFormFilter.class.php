<?php

/**
 * Projet filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProjetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle' => new sfWidgetFormFilterInput(),
      'id_site' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle' => new sfValidatorPass(array('required' => false)),
      'id_site' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('projet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Projet';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'libelle' => 'Text',
      'id_site' => 'ForeignKey',
    );
  }
}
