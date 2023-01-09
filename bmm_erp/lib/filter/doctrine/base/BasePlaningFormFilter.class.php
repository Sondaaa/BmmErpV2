<?php

/**
 * Planing filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlaningFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'montantttc'      => new sfWidgetFormFilterInput(),
      'montanttotalht'  => new sfWidgetFormFilterInput(),
      'datedebutentete' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinentete'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'objet'           => new sfWidgetFormFilterInput(),
      'annee'           => new sfWidgetFormFilterInput(),
      'montantrealise'  => new sfWidgetFormFilterInput(),
      'elignible'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'noneligibletfp'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'montantttc'      => new sfValidatorPass(array('required' => false)),
      'montanttotalht'  => new sfValidatorPass(array('required' => false)),
      'datedebutentete' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinentete'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'objet'           => new sfValidatorPass(array('required' => false)),
      'annee'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'montantrealise'  => new sfValidatorPass(array('required' => false)),
      'elignible'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'noneligibletfp'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('planing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Planing';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'montantttc'      => 'Text',
      'montanttotalht'  => 'Text',
      'datedebutentete' => 'Date',
      'datefinentete'   => 'Date',
      'objet'           => 'Text',
      'annee'           => 'Number',
      'montantrealise'  => 'Text',
      'elignible'       => 'Boolean',
      'noneligibletfp'  => 'Boolean',
    );
  }
}
