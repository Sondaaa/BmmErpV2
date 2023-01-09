<?php

/**
 * Lignerapportcontrole filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignerapportcontroleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'             => new sfWidgetFormFilterInput(),
      'designation'        => new sfWidgetFormFilterInput(),
      'unite'              => new sfWidgetFormFilterInput(),
      'quantite'           => new sfWidgetFormFilterInput(),
      'prixunitaire'       => new sfWidgetFormFilterInput(),
      'prixtotal'          => new sfWidgetFormFilterInput(),
      'observation'        => new sfWidgetFormFilterInput(),
      'id_rapportcontrole' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapportcontrole'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'designation'        => new sfValidatorPass(array('required' => false)),
      'unite'              => new sfValidatorPass(array('required' => false)),
      'quantite'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prixunitaire'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prixtotal'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation'        => new sfValidatorPass(array('required' => false)),
      'id_rapportcontrole' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rapportcontrole'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignerapportcontrole_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignerapportcontrole';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'numero'             => 'Number',
      'designation'        => 'Text',
      'unite'              => 'Text',
      'quantite'           => 'Number',
      'prixunitaire'       => 'Number',
      'prixtotal'          => 'Number',
      'observation'        => 'Text',
      'id_rapportcontrole' => 'ForeignKey',
    );
  }
}
