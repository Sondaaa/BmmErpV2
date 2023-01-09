<?php

/**
 * Sousdirection filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousdirectionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'      => new sfWidgetFormFilterInput(),
      'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'      => new sfValidatorPass(array('required' => false)),
      'id_direction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sousdirection_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousdirection';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'libelle'      => 'Text',
      'id_direction' => 'ForeignKey',
    );
  }
}
