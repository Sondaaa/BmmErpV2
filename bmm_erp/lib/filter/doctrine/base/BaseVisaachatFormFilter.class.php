<?php

/**
 * Visaachat filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVisaachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'chemin'   => new sfWidgetFormFilterInput(),
      'libelle'  => new sfWidgetFormFilterInput(),
      'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'chemin'   => new sfValidatorPass(array('required' => false)),
      'libelle'  => new sfValidatorPass(array('required' => false)),
      'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('visaachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Visaachat';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'chemin'   => 'Text',
      'libelle'  => 'Text',
      'id_agent' => 'ForeignKey',
    );
  }
}
