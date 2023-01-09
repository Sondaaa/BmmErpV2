<?php

/**
 * Tableauxammortisement form base class.
 *
 * @method Tableauxammortisement getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTableauxammortisementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_immobilisation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'add_empty' => true)),
      'date_aquisition'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'vorigine'          => new sfWidgetFormInputText(),
      'taux'              => new sfWidgetFormInputText(),
      'dotation'          => new sfWidgetFormInputText(),
      'amrtinterieur'     => new sfWidgetFormInputText(),
      'amrtcumile'        => new sfWidgetFormInputText(),
      'vcn'               => new sfWidgetFormInputText(),
      'datetableux'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_immobilisation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Immobilisation'), 'column' => 'id', 'required' => false)),
      'date_aquisition'   => new sfValidatorDate(array('required' => false)),
      'vorigine'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'taux'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dotation'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'amrtinterieur'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'amrtcumile'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'vcn'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datetableux'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tableauxammortisement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tableauxammortisement';
  }

}
