<?php

/**
 * Lignedossierfournisseur filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignedossierfournisseurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nordre'        => new sfWidgetFormFilterInput(),
      'name'          => new sfWidgetFormFilterInput(),
      'url'           => new sfWidgetFormFilterInput(),
      'objet'         => new sfWidgetFormFilterInput(),
      'sujet'         => new sfWidgetFormFilterInput(),
      'id_dossierfrs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierfourniseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nordre'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'          => new sfValidatorPass(array('required' => false)),
      'url'           => new sfValidatorPass(array('required' => false)),
      'objet'         => new sfValidatorPass(array('required' => false)),
      'sujet'         => new sfValidatorPass(array('required' => false)),
      'id_dossierfrs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossierfourniseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignedossierfournisseur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedossierfournisseur';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nordre'        => 'Number',
      'name'          => 'Text',
      'url'           => 'Text',
      'objet'         => 'Text',
      'sujet'         => 'Text',
      'id_dossierfrs' => 'ForeignKey',
    );
  }
}
