<?php

/**
 * Etage filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etage'   => new sfWidgetFormFilterInput(),
      'id_site' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'etage'   => new sfValidatorPass(array('required' => false)),
      'id_site' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('etage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etage';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'etage'   => 'Text',
      'id_site' => 'ForeignKey',
    );
  }
}
