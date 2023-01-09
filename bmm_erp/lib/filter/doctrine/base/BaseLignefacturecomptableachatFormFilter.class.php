<?php

/**
 * Lignefacturecomptableachat filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignefacturecomptableachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'totalht'                  => new sfWidgetFormFilterInput(),
      'totaltva'                 => new sfWidgetFormFilterInput(),
      'id_tva'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'id_facturecomptableachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Facturecomptableachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'totalht'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totaltva'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_tva'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
      'id_facturecomptableachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Facturecomptableachat'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignefacturecomptableachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefacturecomptableachat';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'totalht'                  => 'Number',
      'totaltva'                 => 'Number',
      'id_tva'                   => 'ForeignKey',
      'id_facturecomptableachat' => 'ForeignKey',
    );
  }
}
