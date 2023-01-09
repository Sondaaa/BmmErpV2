<?php

/**
 * Parametrebilan filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametrebilanFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'note'           => new sfWidgetFormFilterInput(),
      'type'           => new sfWidgetFormFilterInput(),
      'id_comptedebut' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_2'), 'add_empty' => true)),
      'id_comptefin'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'note'           => new sfValidatorPass(array('required' => false)),
      'type'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_comptedebut' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable_2'), 'column' => 'id')),
      'id_comptefin'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parametrebilan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametrebilan';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'note'           => 'Text',
      'type'           => 'Number',
      'id_comptedebut' => 'ForeignKey',
      'id_comptefin'   => 'ForeignKey',
    );
  }
}
