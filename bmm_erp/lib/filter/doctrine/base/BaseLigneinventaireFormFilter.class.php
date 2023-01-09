<?php

/**
 * Ligneinventaire filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneinventaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_inventaire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventairestock'), 'add_empty' => true)),
      'id_article'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'qtereel'       => new sfWidgetFormFilterInput(),
      'qtetheorique'  => new sfWidgetFormFilterInput(),
      'ecartreel'     => new sfWidgetFormFilterInput(),
      'ecartthorique' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_inventaire' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inventairestock'), 'column' => 'id')),
      'id_article'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'qtereel'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qtetheorique'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ecartreel'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ecartthorique' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ligneinventaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneinventaire';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_inventaire' => 'ForeignKey',
      'id_article'    => 'ForeignKey',
      'qtereel'       => 'Number',
      'qtetheorique'  => 'Number',
      'ecartreel'     => 'Number',
      'ecartthorique' => 'Number',
    );
  }
}
