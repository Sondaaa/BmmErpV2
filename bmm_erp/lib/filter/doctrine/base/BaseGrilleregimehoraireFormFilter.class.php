<?php

/**
 * Grilleregimehoraire filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrilleregimehoraireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_regime' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'annee'     => new sfWidgetFormFilterInput(),
      'jour'      => new sfWidgetFormFilterInput(),
      'nbrheuret' => new sfWidgetFormFilterInput(),
      'jourrepos' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_regime' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id')),
      'annee'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jour'      => new sfValidatorPass(array('required' => false)),
      'nbrheuret' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jourrepos' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('grilleregimehoraire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grilleregimehoraire';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_regime' => 'ForeignKey',
      'annee'     => 'Number',
      'jour'      => 'Text',
      'nbrheuret' => 'Number',
      'jourrepos' => 'Boolean',
    );
  }
}
