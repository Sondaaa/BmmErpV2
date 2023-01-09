<?php

/**
 * Lignecodesociale filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignecodesocialeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_codesoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Codesociale'), 'add_empty' => true)),
      'nordre'     => new sfWidgetFormFilterInput(),
      'libelle'    => new sfWidgetFormFilterInput(),
      'taux'       => new sfWidgetFormFilterInput(),
      'code'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_codesoc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Codesociale'), 'column' => 'id')),
      'nordre'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'libelle'    => new sfValidatorPass(array('required' => false)),
      'taux'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'code'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignecodesociale_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecodesociale';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_codesoc' => 'ForeignKey',
      'nordre'     => 'Number',
      'libelle'    => 'Text',
      'taux'       => 'Number',
      'code'       => 'Number',
    );
  }
}
