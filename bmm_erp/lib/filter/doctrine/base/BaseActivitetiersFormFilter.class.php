<?php

/**
 * Activitetiers filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActivitetiersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'     => new sfWidgetFormFilterInput(),
      'code' => new sfWidgetFormFilterInput(),
      'parent_id' => new sfWidgetFormDoctrineChoice(array('model' =>'Activitetiers','table_method'=>'getParentActivites', 'add_empty' => true,'label'=> 'Activité')),
  
    ));

    $this->setValidators(array(
      'libelle'     => new sfValidatorPass(array('required' => false)),
      'code' => new sfValidatorPass(array('required' => false)),
      'parent_id' =>  new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Activitetiers', 'column' => 'id')),
  
    ));

    $this->widgetSchema->setNameFormat('activitetiers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Activitetiers';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'libelle'     => 'Text',
      'description' => 'Text',
    );
  }
}
