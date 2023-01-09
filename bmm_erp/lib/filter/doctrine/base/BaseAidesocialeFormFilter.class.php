<?php

/**
 * Aidesociale filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAidesocialeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_agents'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'nature'      => new sfWidgetFormFilterInput(),
      'origine'     => new sfWidgetFormFilterInput(),
      'montant'     => new sfWidgetFormFilterInput(),
      'observation' => new sfWidgetFormFilterInput(),
	  'id_typeaide' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaide'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_agents'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'nature'      => new sfValidatorPass(array('required' => false)),
      'origine'     => new sfValidatorPass(array('required' => false)),
      'montant'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation' => new sfValidatorPass(array('required' => false)),
	  'id_typeaide' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeaide'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('aidesociale_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aidesociale';
  }

  public function getFields()
  {
    return array(
      'date'        => 'Date',
      'id'          => 'Number',
      'id_agents'   => 'ForeignKey',
      'nature'      => 'Text',
      'origine'     => 'Text',
      'montant'     => 'Number',
      'observation' => 'Text',
	     'id_typeaide' => 'ForeignKey',
    );
  }
}
