<?php

/**
 * Ligneregimehoraire filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneregimehoraireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_regime'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'id_dossier'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'designation' => new sfWidgetFormFilterInput(),
      'nordre'      => new sfWidgetFormFilterInput(),
      'pardefaut'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_regime'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id')),
      'id_dossier'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
      'designation' => new sfValidatorPass(array('required' => false)),
      'nordre'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pardefaut'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('ligneregimehoraire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneregimehoraire';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_regime'   => 'ForeignKey',
      'id_dossier'  => 'ForeignKey',
      'designation' => 'Text',
      'nordre'      => 'Number',
      'pardefaut'   => 'Boolean',
    );
  }
}
