<?php

/**
 * Role filter form base class.
 *
 * @package    InventaireTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'role' => new sfWidgetFormFilterInput(),
	    'id_famexpdes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'role' => new sfValidatorPass(array('required' => false)),
	  'id_famexpdes' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('role_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'role' => 'Text',
    );
  }
}
