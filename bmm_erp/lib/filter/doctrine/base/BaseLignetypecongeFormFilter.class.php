<?php

/**
 * Lignetypeconge filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignetypecongeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
  'nordre'           => new sfWidgetFormFilterInput(),
       
	'typetraitement'   => new sfWidgetFormFilterInput(),
      'commisioncomplet' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nbrjour'          => new sfWidgetFormFilterInput(),
      'id_typeconge'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeconge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
   'nordre'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
       
	'typetraitement'   => new sfValidatorPass(array('required' => false)),
      'commisioncomplet' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nbrjour'          => new sfValidatorPass(array('required' => false)),
      'id_typeconge'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeconge'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignetypeconge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignetypeconge';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
	    'nordre'           => 'Number',
      'typetraitement'   => 'Text',
      'commisioncomplet' => 'Boolean',
      'nbrjour'          => 'Text',
      'id_typeconge'     => 'ForeignKey',
    );
  }
}
