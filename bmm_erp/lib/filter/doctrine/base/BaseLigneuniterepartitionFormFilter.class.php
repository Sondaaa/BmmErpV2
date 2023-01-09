<?php

/**
 * Ligneuniterepartition filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneuniterepartitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'jourmod'             => new sfWidgetFormFilterInput(),
      'montantmod'          => new sfWidgetFormFilterInput(),
      'coefficient'         => new sfWidgetFormFilterInput(),
      'intrant'             => new sfWidgetFormFilterInput(),
      'mecanisation'        => new sfWidgetFormFilterInput(),
      'fraisgeneraux'       => new sfWidgetFormFilterInput(),
      'total'               => new sfWidgetFormFilterInput(),
      'compteapproprie'     => new sfWidgetFormFilterInput(),
      'id_uniterepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'jourmod'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantmod'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'coefficient'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'intrant'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mecanisation'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fraisgeneraux'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'compteapproprie'     => new sfValidatorPass(array('required' => false)),
      'id_uniterepartition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ligneuniterepartition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneuniterepartition';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'jourmod'             => 'Number',
      'montantmod'          => 'Number',
      'coefficient'         => 'Number',
      'intrant'             => 'Number',
      'mecanisation'        => 'Number',
      'fraisgeneraux'       => 'Number',
      'total'               => 'Number',
      'compteapproprie'     => 'Text',
      'id_uniterepartition' => 'ForeignKey',
    );
  }
}
