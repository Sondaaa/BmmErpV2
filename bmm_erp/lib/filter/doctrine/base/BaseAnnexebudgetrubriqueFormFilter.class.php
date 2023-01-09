<?php

/**
 * Annexebudgetrubrique filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnnexebudgetrubriqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datecreation'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'description'     => new sfWidgetFormFilterInput(),
      'contenu'         => new sfWidgetFormFilterInput(),
      'total'           => new sfWidgetFormFilterInput(),
      'id_annexebudget' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Annexebudget'), 'add_empty' => true)),
      'id_ligprotitrub' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'datecreation'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'description'     => new sfValidatorPass(array('required' => false)),
      'contenu'         => new sfValidatorPass(array('required' => false)),
      'total'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_annexebudget' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Annexebudget'), 'column' => 'id')),
      'id_ligprotitrub' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('annexebudgetrubrique_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annexebudgetrubrique';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'datecreation'    => 'Date',
      'description'     => 'Text',
      'contenu'         => 'Text',
      'total'           => 'Number',
      'id_annexebudget' => 'ForeignKey',
      'id_ligprotitrub' => 'ForeignKey',
    );
  }
}
