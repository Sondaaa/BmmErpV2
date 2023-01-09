<?php

/**
 * Annexebudgetligne filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnnexebudgetligneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'rang'            => new sfWidgetFormFilterInput(),
      'libelle'         => new sfWidgetFormFilterInput(),
      'type'            => new sfWidgetFormFilterInput(),
      'nature'          => new sfWidgetFormFilterInput(),
      'formule'         => new sfWidgetFormFilterInput(),
      'sommation'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_annexebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Annexebudget'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'rang'            => new sfValidatorPass(array('required' => false)),
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'type'            => new sfValidatorPass(array('required' => false)),
      'nature'          => new sfValidatorPass(array('required' => false)),
      'formule'         => new sfValidatorPass(array('required' => false)),
      'sommation'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_annexebudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Annexebudget'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('annexebudgetligne_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annexebudgetligne';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'rang'            => 'Text',
      'libelle'         => 'Text',
      'type'            => 'Text',
      'nature'          => 'Text',
      'formule'         => 'Text',
      'sommation'       => 'Boolean',
      'id_annexebudget' => 'ForeignKey',
    );
  }
}
