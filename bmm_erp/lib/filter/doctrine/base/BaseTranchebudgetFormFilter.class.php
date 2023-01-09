<?php

/**
 * Tranchebudget filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTranchebudgetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nordre'                => new sfWidgetFormFilterInput(),
      'datetranche'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'mntpourcentage'        => new sfWidgetFormFilterInput(),
      'mntvaleur'             => new sfWidgetFormFilterInput(),
      'id_titrebudget'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_parametragetranche' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parametragetranche'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nordre'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datetranche'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'mntpourcentage'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mntvaleur'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_titrebudget'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'id_parametragetranche' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Parametragetranche'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tranchebudget_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tranchebudget';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'nordre'                => 'Number',
      'datetranche'           => 'Date',
      'mntpourcentage'        => 'Number',
      'mntvaleur'             => 'Number',
      'id_titrebudget'        => 'ForeignKey',
      'id_parametragetranche' => 'ForeignKey',
    );
  }
}
