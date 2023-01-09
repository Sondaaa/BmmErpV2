<?php

/**
 * Parametrebilan form base class.
 *
 * @method Parametrebilan getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParametrebilanForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'note'           => new sfWidgetFormInputText(),
      'type'           => new sfWidgetFormInputText(),
      'id_comptedebut' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_2'), 'add_empty' => true)),
      'id_comptefin'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'note'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'type'           => new sfValidatorInteger(array('required' => false)),
      'id_comptedebut' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable_2'), 'required' => false)),
      'id_comptefin'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametrebilan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametrebilan';
  }

}
