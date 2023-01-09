<?php

/**
 * Docachatreg filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocachatregFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_docreg'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_3'), 'add_empty' => true)),
      'id_demandeur'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
      'id_bci'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_useracheteur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_docreg'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat_3'), 'column' => 'id')),
      'id_demandeur'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandeur'), 'column' => 'id')),
      'id_bci'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'id_useracheteur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('docachatreg_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Docachatreg';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_docreg'       => 'ForeignKey',
      'id_demandeur'    => 'ForeignKey',
      'id_bci'          => 'ForeignKey',
      'id_useracheteur' => 'ForeignKey',
    );
  }
}
