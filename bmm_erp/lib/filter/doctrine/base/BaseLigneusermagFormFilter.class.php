<?php

/**
 * Ligneusermag filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneusermagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_role'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => true)),
      'id_mag'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_agent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_role'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Role'), 'column' => 'id')),
      'id_mag'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ligneusermag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneusermag';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'id_agent' => 'ForeignKey',
      'id_role'  => 'ForeignKey',
      'id_mag'   => 'ForeignKey',
    );
  }
}
