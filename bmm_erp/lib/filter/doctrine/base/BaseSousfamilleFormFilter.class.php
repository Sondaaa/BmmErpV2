<?php

/**
 * Sousfamille filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousfamilleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sousfamille' => new sfWidgetFormFilterInput(),
      'id_famille'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
      'description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sousfamille' => new sfValidatorPass(array('required' => false)),
      'id_famille'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famille'), 'column' => 'id')),
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousfamille_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousfamille';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'sousfamille' => 'Text',
      'id_famille'  => 'ForeignKey',
      'description' => 'Text',
    );
  }
}
