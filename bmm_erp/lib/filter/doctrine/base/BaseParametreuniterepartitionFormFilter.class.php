<?php

/**
 * Parametreuniterepartition filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametreuniterepartitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typemecanisation'       => new sfWidgetFormFilterInput(),
      'id_chantierrepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'add_empty' => true)),
      'id_rapporttravaux'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
      'id_uniterepartition'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'typemecanisation'       => new sfValidatorPass(array('required' => false)),
      'id_chantierrepartition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'column' => 'id')),
      'id_rapporttravaux'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rapporttravaux'), 'column' => 'id')),
      'id_uniterepartition'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parametreuniterepartition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametreuniterepartition';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'typemecanisation'       => 'Text',
      'id_chantierrepartition' => 'ForeignKey',
      'id_rapporttravaux'      => 'ForeignKey',
      'id_uniterepartition'    => 'ForeignKey',
    );
  }
}
