<?php

/**
 * Activitetiers form base class.
 *
 * @method Activitetiers getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActivitetiersForm extends BaseFormDoctrine
{
  public function setup()
  {
   
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'parent_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Activitetiers', 'table_method' => 'getParentActivites', 'add_empty' => true, 'label' => 'Activité')),

      'libelle'     => new sfWidgetFormInputText(array('label' => 'Nom du sous activité/activité')),
      'code' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'     => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'code' => new sfValidatorString(array('required' => false)),
      'parent_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('activitetiers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Activitetiers';
  }
}
