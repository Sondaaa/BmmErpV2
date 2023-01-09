<?php

/**
 * Ligneprimecontrat filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneprimecontratFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_prime'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Primes'), 'add_empty' => true)),
      'libelle'                   => new sfWidgetFormFilterInput(),
      'id_contrat'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'nordre'                    => new sfWidgetFormFilterInput(),
      'datedebutvalidemodifprime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinvalidemodifiprime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_agents'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_prime'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Primes'), 'column' => 'id')),
      'libelle'                   => new sfValidatorPass(array('required' => false)),
      'id_contrat'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contrat'), 'column' => 'id')),
      'nordre'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebutvalidemodifprime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinvalidemodifiprime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('ligneprimecontrat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneprimecontrat';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'id_agents'                 => 'ForeignKey',
      'id_prime'                  => 'ForeignKey',
      'libelle'                   => 'Text',
      'id_contrat'                => 'ForeignKey',
      'nordre'                    => 'Number',
      'datedebutvalidemodifprime' => 'Date',
      'datefinvalidemodifiprime'  => 'Date',
    );
  }
}
