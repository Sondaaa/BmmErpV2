<?php

/**
 * Referentielmarche filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReferentielmarcheFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'       => new sfWidgetFormFilterInput(),
      'url'           => new sfWidgetFormFilterInput(),
      'id_utlisateur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'standard'      => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'       => new sfValidatorPass(array('required' => false)),
      'url'           => new sfValidatorPass(array('required' => false)),
      'id_utlisateur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'standard'      => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('referentielmarche_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Referentielmarche';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'libelle'       => 'Text',
      'url'           => 'Text',
      'id_utlisateur' => 'ForeignKey',
      'standard'      => 'Text',
      'description'   => 'Text',
    );
  }
}
