<?php

/**
 * Lignemagbureau filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignemagbureauFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_mag' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_bur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_mag' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
      'id_bur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignemagbureau_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemagbureau';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'id_mag' => 'ForeignKey',
      'id_bur' => 'ForeignKey',
    );
  }
}
