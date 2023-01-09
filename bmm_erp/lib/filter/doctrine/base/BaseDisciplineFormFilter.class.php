<?php

/**
 * Discipline filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDisciplineFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_agents'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_typediscipline'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscipline'), 'add_empty' => true)),
      'source'              => new sfWidgetFormFilterInput(),
      'date'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'explication'         => new sfWidgetFormFilterInput(),
      'id_naturediscipline' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturediscipline'), 'add_empty' => true)),
         'nbrejour'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_agents'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'id_typediscipline'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typediscipline'), 'column' => 'id')),
      'source'              => new sfValidatorPass(array('required' => false)),
      'date'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'explication'         => new sfValidatorPass(array('required' => false)),
      'id_naturediscipline' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturediscipline'), 'column' => 'id')),
         'nbrejour'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('discipline_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Discipline';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'id_agents'           => 'ForeignKey',
      'id_typediscipline'   => 'ForeignKey',
      'source'              => 'Text',
      'date'                => 'Date',
      'explication'         => 'Text',
      'id_naturediscipline' => 'ForeignKey',
    );
  }
}
