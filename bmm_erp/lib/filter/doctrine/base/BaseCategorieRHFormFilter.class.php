<?php

/**
 * Categorierh filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategorierhFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'      => new sfWidgetFormFilterInput(),
      'id_corps'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Corps'), 'add_empty' => true)),
      'id_souscorps' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Souscorps'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'      => new sfValidatorPass(array('required' => false)),
      'id_corps'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Corps'), 'column' => 'id')),
      'id_souscorps' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Souscorps'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('categorierh_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categorierh';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'libelle'      => 'Text',
      'id_corps'     => 'ForeignKey',
      'id_souscorps' => 'ForeignKey',
    );
  }
}
