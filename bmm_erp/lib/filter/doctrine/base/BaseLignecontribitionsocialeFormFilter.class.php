<?php

/**
 * Lignecontribitionsociale filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignecontribitionsocialeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_contribition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'nordre'          => new sfWidgetFormFilterInput(),
      'code'            => new sfWidgetFormFilterInput(),
      'libelle'         => new sfWidgetFormFilterInput(),
      'taux'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_contribition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id')),
      'nordre'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'taux'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignecontribitionsociale_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecontribitionsociale';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_contribition' => 'ForeignKey',
      'nordre'          => 'Number',
      'code'            => 'Number',
      'libelle'         => 'Text',
      'taux'            => 'Number',
    );
  }
}
