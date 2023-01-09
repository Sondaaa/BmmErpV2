<?php

/**
 * Taches filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTachesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'    => new sfWidgetFormFilterInput(),
      'id_posterh' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posterh'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'    => new sfValidatorPass(array('required' => false)),
      'id_posterh' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posterh'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('taches_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taches';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'libelle'    => 'Text',
      'id_posterh' => 'ForeignKey',
    );
  }
}
