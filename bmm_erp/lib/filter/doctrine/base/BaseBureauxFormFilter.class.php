<?php

/**
 * Bureaux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBureauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bureau'       => new sfWidgetFormFilterInput(),
      'id_etage'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'add_empty' => true)),
      'code'         => new sfWidgetFormFilterInput(),
      'id_type'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typebureaux'), 'add_empty' => true)),
       'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'bureau'       => new sfValidatorPass(array('required' => false)),
      'id_etage'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etage'), 'column' => 'id')),
      'code'         => new sfValidatorPass(array('required' => false)),
      'id_type'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typebureaux'), 'column' => 'id')),
       'id_direction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bureaux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bureaux';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'bureau'       => 'Text',
      'id_etage'     => 'ForeignKey',
      'code'         => 'Text',
      'id_type'      => 'ForeignKey',
      'id_mag'       => 'ForeignKey',
      'id_direction' => 'ForeignKey',
    );
  }
}
