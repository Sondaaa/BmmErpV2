<?php

/**
 * Lignefraisgeneraux form base class.
 *
 * @method Lignefraisgeneraux getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignefraisgenerauxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'id_plandossiercomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'add_empty' => true)),
      'montant'                 => new sfWidgetFormInputText(),
      'id_fraisgeneraux'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fraisgeneraux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_plandossiercomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plandossiercomptable'), 'required' => false)),
      'montant'                 => new sfValidatorNumber(array('required' => false)),
      'id_fraisgeneraux'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fraisgeneraux'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignefraisgeneraux[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefraisgeneraux';
  }

}
