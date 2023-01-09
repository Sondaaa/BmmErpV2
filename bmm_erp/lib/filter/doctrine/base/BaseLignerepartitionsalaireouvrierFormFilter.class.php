<?php

/**
 * Lignerepartitionsalaireouvrier filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignerepartitionsalaireouvrierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_chantierrepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'add_empty' => true)),
      'mois'                   => new sfWidgetFormFilterInput(),
      'jour'                   => new sfWidgetFormFilterInput(),
      'montant'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_chantierrepartition' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Chantierrepartitionsalaireouvrier'), 'column' => 'id')),
      'mois'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jour'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montant'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignerepartitionsalaireouvrier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignerepartitionsalaireouvrier';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'id_chantierrepartition' => 'ForeignKey',
      'mois'                   => 'Number',
      'jour'                   => 'Number',
      'montant'                => 'Number',
    );
  }
}
