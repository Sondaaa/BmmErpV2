<?php

/**
 * Lignecararticle filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignecararticleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valeurlibelle' => new sfWidgetFormFilterInput(),
      'id_article'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_car'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caracteristiquearticle'), 'add_empty' => true)),
      'code'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'valeurlibelle' => new sfValidatorPass(array('required' => false)),
      'id_article'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'id_car'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caracteristiquearticle'), 'column' => 'id')),
      'code'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignecararticle_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecararticle';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'valeurlibelle' => 'Text',
      'id_article'    => 'ForeignKey',
      'id_car'        => 'ForeignKey',
      'code'          => 'Text',
    );
  }
}
