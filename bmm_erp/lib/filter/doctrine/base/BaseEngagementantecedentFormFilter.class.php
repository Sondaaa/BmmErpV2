<?php

/**
 * Engagementantecedent filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEngagementantecedentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'annee'           => new sfWidgetFormFilterInput(),
      'id_titre'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_ligprotitrub' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_docachat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'description'     => new sfWidgetFormFilterInput(),
      'montant'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'annee'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_titre'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'id_ligprotitrub' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'id_docachat'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'description'     => new sfValidatorPass(array('required' => false)),
      'montant'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('engagementantecedent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Engagementantecedent';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'date'            => 'Date',
      'annee'           => 'Number',
      'id_titre'        => 'ForeignKey',
      'id_ligprotitrub' => 'ForeignKey',
      'id_docachat'     => 'ForeignKey',
      'description'     => 'Text',
      'montant'         => 'Number',
    );
  }
}
