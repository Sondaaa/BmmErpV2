<?php

/**
 * Parametrebilancompte filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametrebilancompteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'note'      => new sfWidgetFormFilterInput(),
	   'regrouppement'      => new sfWidgetFormFilterInput(),
      'type'      => new sfWidgetFormFilterInput(),
      'id_compte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'note'      => new sfValidatorPass(array('required' => false)),
	  'regrouppement'      => new sfValidatorPass(array('required' => false)),
      'type'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_compte' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plandossiercomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parametrebilancompte_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametrebilancompte';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'note'      => 'Text',
	  
	   'regrouppement'      => 'Text',
      'type'      => 'Number',
      'id_compte' => 'ForeignKey',
    );
  }
}
