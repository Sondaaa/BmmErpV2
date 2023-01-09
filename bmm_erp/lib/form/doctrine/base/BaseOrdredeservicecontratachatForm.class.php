<?php

/**
 * Ordredeservicecontratachat form base class.
 *
 * @method Ordredeservicecontratachat getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrdredeservicecontratachatForm extends BaseFormDoctrine
{
  public function setup()
  {$min = date('Y-m-d');
        if (!$this->getObject()->isNew())
            $min = $this->getObject()->getDateios();
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'reference'   => new sfWidgetFormTextarea(),
      'object'      => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'id_type'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'add_empty' => true)),
      'dateios'     => new sfWidgetFormInputText(array(), array('type' => 'date', 'min' => $min)),
      'id_contrat'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'id_docachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'delaios'     => new sfWidgetFormInputText(),
      'id_frs'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference'   => new sfValidatorString(array('required' => false)),
      'object'      => new sfValidatorString(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'id_type'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'required' => false)),
      'dateios'     => new sfValidatorDate(array('required' => false)),
      'id_contrat'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'required' => false)),
      'id_docachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
      'delaios'     => new sfValidatorInteger(array('required' => false)),
      'id_frs'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ordredeservicecontratachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ordredeservicecontratachat';
  }

}
