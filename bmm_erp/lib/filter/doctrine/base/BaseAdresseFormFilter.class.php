<?php

/**
 * Adresse filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdresseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'adresse'       => new sfWidgetFormFilterInput(),
      'id_couvernera' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'codepostal'    => new sfWidgetFormFilterInput(),
      'id_frs'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'adresse'       => new sfValidatorPass(array('required' => false)),
      'id_couvernera' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id')),
      'codepostal'    => new sfValidatorPass(array('required' => false)),
      'id_frs'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('adresse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adresse';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'adresse'       => 'Text',
      'id_couvernera' => 'ForeignKey',
      'codepostal'    => 'Text',
      'id_frs'        => 'ForeignKey',
    );
  }
}
