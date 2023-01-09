<?php

/**
 * Typeconge filter form base class.
 *
 * @package    PhpProjecttest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypecongeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'        => new sfWidgetFormFilterInput(),
      'nbrjour'        => new sfWidgetFormFilterInput(),
      'modalitecalcul' => new sfWidgetFormFilterInput(),
      'paye'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'libelle'        => new sfValidatorPass(array('required' => false)),
      'nbrjour'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modalitecalcul' => new sfValidatorPass(array('required' => false)),
      'paye'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('typeconge_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeconge';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'libelle'        => 'Text',
      'nbrjour'        => 'Number',
      'modalitecalcul' => 'Text',
      'paye'           => 'Boolean',
    );
  }
}
