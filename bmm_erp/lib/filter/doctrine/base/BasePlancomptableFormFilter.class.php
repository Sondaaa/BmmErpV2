<?php

/**
 * Plancomptable filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlancomptableFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numerocompte' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typesolde'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lettrage'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'standard'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_classe'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classecompte'), 'add_empty' => true)),
      'id_devise'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_compte'    => new sfWidgetFormFilterInput(),
      'id_user'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
	 'ensommeil' => new sfWidgetFormFilterInput(array('with_empty' => false)),
	 'senspardefaut' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'numerocompte' => new sfValidatorPass(array('required' => false)),
	  'senspardefaut' => new sfValidatorPass(array('required' => false)),
	  'ensommeil' => new sfValidatorPass(array('required' => false)),
      'typesolde'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lettrage'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'standard'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_classe'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Classecompte'), 'column' => 'id')),
      'id_devise'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
      'id_compte'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_user'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('plancomptable_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plancomptable';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'numerocompte' => 'Text',
      'typesolde'    => 'Number',
      'lettrage'     => 'Number',
      'standard'     => 'Number',
      'date'         => 'Date',
      'id_classe'    => 'ForeignKey',
      'id_devise'    => 'ForeignKey',
      'id_compte'    => 'Number',
      'id_user'      => 'ForeignKey',
    );
  }
}
