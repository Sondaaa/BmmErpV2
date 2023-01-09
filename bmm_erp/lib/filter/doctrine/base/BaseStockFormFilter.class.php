<?php

/**
 * Stock filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_article'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_mag'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'datedentre'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'qtereel'       => new sfWidgetFormFilterInput(),
      'qtetheorique'  => new sfWidgetFormFilterInput(),
      'valeurreel'    => new sfWidgetFormFilterInput(),
      'stockmax'      => new sfWidgetFormFilterInput(),
      'stockmin'      => new sfWidgetFormFilterInput(),
      'stocksecurite' => new sfWidgetFormFilterInput(),
      'stockalert'    => new sfWidgetFormFilterInput(),
      'id_store'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Storemag'), 'add_empty' => true)),
      'puht'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_article'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'id_mag'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
      'datedentre'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'qtereel'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qtetheorique'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'valeurreel'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stockmax'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stockmin'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stocksecurite' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stockalert'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_store'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Storemag'), 'column' => 'id')),
      'puht'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('stock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stock';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_article'    => 'ForeignKey',
      'id_mag'        => 'ForeignKey',
      'datedentre'    => 'Date',
      'qtereel'       => 'Number',
      'qtetheorique'  => 'Number',
      'valeurreel'    => 'Number',
      'stockmax'      => 'Number',
      'stockmin'      => 'Number',
      'stocksecurite' => 'Number',
      'stockalert'    => 'Number',
      'id_store'      => 'ForeignKey',
      'puht'          => 'Number',
    );
  }
}
