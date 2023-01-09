<?php

/**
 * Ligneuniterepartition form base class.
 *
 * @method Ligneuniterepartition getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLigneuniterepartitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'jourmod'             => new sfWidgetFormInputText(),
      'montantmod'          => new sfWidgetFormInputText(),
      'coefficient'         => new sfWidgetFormInputText(),
      'intrant'             => new sfWidgetFormInputText(),
      'mecanisation'        => new sfWidgetFormInputText(),
      'fraisgeneraux'       => new sfWidgetFormInputText(),
      'total'               => new sfWidgetFormInputText(),
      'compteapproprie'     => new sfWidgetFormInputText(),
      'id_uniterepartition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'jourmod'             => new sfValidatorInteger(array('required' => false)),
      'montantmod'          => new sfValidatorNumber(array('required' => false)),
      'coefficient'         => new sfValidatorNumber(array('required' => false)),
      'intrant'             => new sfValidatorNumber(array('required' => false)),
      'mecanisation'        => new sfValidatorNumber(array('required' => false)),
      'fraisgeneraux'       => new sfValidatorNumber(array('required' => false)),
      'total'               => new sfValidatorNumber(array('required' => false)),
      'compteapproprie'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_uniterepartition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Uniterepartitioncharge'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneuniterepartition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneuniterepartition';
  }

}
