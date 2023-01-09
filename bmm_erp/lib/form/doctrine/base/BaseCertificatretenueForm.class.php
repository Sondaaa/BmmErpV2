<?php

/**
 * Certificatretenue form base class.
 *
 * @method Certificatretenue getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCertificatretenueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_fournisseur'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_documentbudget'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
      'objetreglement'       => new sfWidgetFormInputText(),
      'montantordonnance'    => new sfWidgetFormInputText(),
      'montantordonnancenet' => new sfWidgetFormInputText(),
      'montantht'            => new sfWidgetFormInputText(),
      'tvadue'               => new sfWidgetFormInputText(),
      'tvacomprise'          => new sfWidgetFormInputText(),
      'tvaretenue'           => new sfWidgetFormInputText(),
      'montantretenue'       => new sfWidgetFormInputText(),
      'datecreation'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_retenuesource'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_fournisseur'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'id_documentbudget'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id', 'required' => false)),
      'objetreglement'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'montantordonnance'    => new sfValidatorNumber(array('required' => false)),
      'montantordonnancenet' => new sfValidatorNumber(array('required' => false)),
      'montantht'            => new sfValidatorNumber(array('required' => false)),
      'tvadue'               => new sfValidatorNumber(array('required' => false)),
      'tvacomprise'          => new sfValidatorNumber(array('required' => false)),
      'tvaretenue'           => new sfValidatorNumber(array('required' => false)),
      'montantretenue'       => new sfValidatorNumber(array('required' => false)),
      'datecreation'         => new sfValidatorDate(array('required' => false)),
      'id_retenuesource'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Retenuesource'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('certificatretenue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Certificatretenue';
  }

}
