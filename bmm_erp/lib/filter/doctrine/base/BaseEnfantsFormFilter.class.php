<?php

/**
 * Enfants filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEnfantsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'           => new sfWidgetFormFilterInput(),
      'prenom'        => new sfWidgetFormFilterInput(),
      'observation'   => new sfWidgetFormFilterInput(),
      'id_agents'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'datenaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nordre'        => new sfWidgetFormFilterInput(),
      'datemajeur'    => new sfWidgetFormFilterInput(),
      'id_deduction'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Deductioncommune'), 'add_empty' => true)),
      'etat'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'etudiant'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'boursie'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'nom'           => new sfValidatorPass(array('required' => false)),
      'prenom'        => new sfValidatorPass(array('required' => false)),
      'observation'   => new sfValidatorPass(array('required' => false)),
      'id_agents'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'datenaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nordre'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datemajeur'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_deduction'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Deductioncommune'), 'column' => 'id')),
      'etat'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'etudiant'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'boursie'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('enfants_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Enfants';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nom'           => 'Text',
      'prenom'        => 'Text',
      'observation'   => 'Text',
      'id_agents'     => 'ForeignKey',
      'datenaissance' => 'Date',
      'nordre'        => 'Number',
      'datemajeur'    => 'Number',
      'id_deduction'  => 'ForeignKey',
      'etat'          => 'Boolean',
      'etudiant'      => 'Boolean',
      'boursie'       => 'Boolean',
    );
  }
}
