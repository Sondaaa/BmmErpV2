<?php

/**
 * Grillepresence filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrillepresenceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_presnece'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Presence'), 'add_empty' => true)),
      'jour'          => new sfWidgetFormFilterInput(),
      'semaine'       => new sfWidgetFormFilterInput(),
      'heuresupp'     => new sfWidgetFormFilterInput(),
      'totalhsemaine' => new sfWidgetFormFilterInput(),
      'totalhsupp'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_presnece'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Presence'), 'column' => 'id')),
      'jour'          => new sfValidatorPass(array('required' => false)),
      'semaine'       => new sfValidatorPass(array('required' => false)),
      'heuresupp'     => new sfValidatorPass(array('required' => false)),
      'totalhsemaine' => new sfValidatorPass(array('required' => false)),
      'totalhsupp'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grillepresence_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grillepresence';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_presnece'   => 'ForeignKey',
      'jour'          => 'Text',
      'semaine'       => 'Text',
      'heuresupp'     => 'Text',
      'totalhsemaine' => 'Text',
      'totalhsupp'    => 'Text',
	  	   'id_motif'         => 'ForeignKey',
    );
  }
}
