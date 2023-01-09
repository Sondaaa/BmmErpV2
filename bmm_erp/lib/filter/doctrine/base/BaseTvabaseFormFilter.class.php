<?php

/**
 * Tvabase filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTvabaseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'    => new sfWidgetFormFilterInput(),
      'valeurbase' => new sfWidgetFormFilterInput(),
      'id_doc'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'    => new sfValidatorPass(array('required' => false)),
      'valeurbase' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_doc'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tvabase_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tvabase';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'libelle'    => 'Text',
      'valeurbase' => 'Number',
      'id_doc'     => 'ForeignKey',
    );
  }
}
