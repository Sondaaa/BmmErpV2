<?php

/**
 * Lignefraisgeneraux filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignefraisgenerauxFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_plandossiercomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'montant'                 => new sfWidgetFormFilterInput(),
      'id_fraisgeneraux'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fraisgeneraux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_plandossiercomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id')),
      'montant'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_fraisgeneraux'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fraisgeneraux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignefraisgeneraux_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefraisgeneraux';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'id_plandossiercomptable' => 'ForeignKey',
      'montant'                 => 'Number',
      'id_fraisgeneraux'        => 'ForeignKey',
    );
  }
}
