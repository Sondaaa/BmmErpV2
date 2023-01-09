<?php

/**
 * Situationcumulee filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSituationcumuleeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'id_ligprotitre' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mnt_engagement' => new sfWidgetFormFilterInput(),
      'mnt_paiement'   => new sfWidgetFormFilterInput(),
      'lib_rubrique'   => new sfWidgetFormFilterInput(),
      'annees'         => new sfWidgetFormFilterInput(),
      'mois'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_titre'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id')),
      'id_ligprotitre' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'mnt_engagement' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnt_paiement'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'lib_rubrique'   => new sfValidatorPass(array('required' => false)),
      'annees'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mois'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('situationcumulee_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Situationcumulee';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_titre'       => 'ForeignKey',
      'id_rubrique'    => 'ForeignKey',
      'id_ligprotitre' => 'ForeignKey',
      'mnt_engagement' => 'Number',
      'mnt_paiement'   => 'Number',
      'lib_rubrique'   => 'Text',
      'annees'         => 'Number',
      'mois'           => 'Number',
    );
  }
}
