<?php

/**
 * Tenues filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTenuesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tache'           => new sfWidgetFormFilterInput(),
      'id_agents'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'observation'     => new sfWidgetFormFilterInput(),
      'caracteristique' => new sfWidgetFormFilterInput(),
	  'id_ouvrier'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ouvrier'), 'add_empty' => true)),
      'personnel'       => new sfWidgetFormFilterInput(),
     'date'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
     'id_typetenue'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typetenue'), 'add_empty' => true)),
	  'id_typemission'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemission'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tache'           => new sfValidatorPass(array('required' => false)),
      'id_agents'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
      'observation'     => new sfValidatorPass(array('required' => false)),
      'caracteristique' => new sfValidatorPass(array('required' => false)),
	  'id_ouvrier'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ouvrier'), 'column' => 'id')),
      'personnel'       => new sfValidatorPass(array('required' => false)),
	  'date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_typetenue'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typetenue'), 'column' => 'id')) ,   
	  'id_typemission'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typemission'), 'column' => 'id')),
   ));

    $this->widgetSchema->setNameFormat('tenues_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tenues';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'tache'           => 'Text',
      'id_agents'       => 'ForeignKey',
      'observation'     => 'Text',
      'caracteristique' => 'Text',
	  'id_typetenue'    => 'ForeignKey',
      'id_typemission'  => 'ForeignKey',
    );
  }
}
