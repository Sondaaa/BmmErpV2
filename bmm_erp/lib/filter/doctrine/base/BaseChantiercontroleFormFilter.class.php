<?php

/**
 * Chantiercontrole filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseChantiercontroleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datecreation'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'libelle'         => new sfWidgetFormFilterInput(),
      'reference'       => new sfWidgetFormFilterInput(),
      'objet'           => new sfWidgetFormFilterInput(),
      'attributaire'    => new sfWidgetFormFilterInput(),
      'id_lieuchantier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieuchantier'), 'add_empty' => true)),
      'dureeprobable'   => new sfWidgetFormFilterInput(),
      'datedemarrage'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'montant'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'datecreation'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libelle'         => new sfValidatorPass(array('required' => false)),
      'reference'       => new sfValidatorPass(array('required' => false)),
      'objet'           => new sfValidatorPass(array('required' => false)),
      'attributaire'    => new sfValidatorPass(array('required' => false)),
      'id_lieuchantier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lieuchantier'), 'column' => 'id')),
      'dureeprobable'   => new sfValidatorPass(array('required' => false)),
      'datedemarrage'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'montant'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('chantiercontrole_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Chantiercontrole';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'datecreation'    => 'Date',
      'libelle'         => 'Text',
      'reference'       => 'Text',
      'objet'           => 'Text',
      'attributaire'    => 'Text',
      'id_lieuchantier' => 'ForeignKey',
      'dureeprobable'   => 'Text',
      'datedemarrage'   => 'Date',
      'montant'         => 'Number',
    );
  }
}
