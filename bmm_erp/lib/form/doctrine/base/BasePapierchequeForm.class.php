<?php

/**
 * Papiercheque form base class.
 *
 * @method Papiercheque getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePapierchequeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_carnet'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetcheque'), 'add_empty' => false)),
      'refpapier'     => new sfWidgetFormInputText(),
      'mntcheque'     => new sfWidgetFormInputText(),
      'datesignature' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'cible'         => new sfWidgetFormInputText(),
      'etat'          => new sfWidgetFormInputCheckbox(),
      'annule'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_carnet'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Carnetcheque'), 'column' => 'id')),
      'refpapier'     => new sfValidatorNumber(),
      'mntcheque'     => new sfValidatorNumber(array('required' => false)),
      'datesignature' => new sfValidatorDate(array('required' => false)),
      'cible'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'etat'          => new sfValidatorBoolean(array('required' => false)),
      'annule'        => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('papiercheque[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Papiercheque';
  }

}
