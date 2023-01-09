<?php

/**
 * Parents filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'           => new sfWidgetFormFilterInput(),
      'prenom'        => new sfWidgetFormFilterInput(),
      'datenaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_agents'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'observtaion'   => new sfWidgetFormFilterInput(),
      'nordre'        => new sfWidgetFormFilterInput(),
      'etat'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_bureau'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nom'           => new sfValidatorPass(array('required' => false)),
      'prenom'        => new sfValidatorPass(array('required' => false)),
      'datenaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_agents'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'observtaion'   => new sfValidatorPass(array('required' => false)),
      'nordre'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'etat'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_bureau'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parents_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parents';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nom'           => 'Text',
      'prenom'        => 'Text',
      'datenaissance' => 'Date',
      'id_agents'     => 'ForeignKey',
      'observtaion'   => 'Text',
      'nordre'        => 'Number',
      'etat'          => 'Boolean',
      'id_bureau'     => 'ForeignKey',
    );
  }
}
