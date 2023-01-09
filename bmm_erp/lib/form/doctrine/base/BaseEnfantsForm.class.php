<?php

/**
 * Enfants form base class.
 *
 * @method Enfants getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseEnfantsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'nom'           => new sfWidgetFormInputText(),
      'prenom'        => new sfWidgetFormInputText(),
      'observation'   => new sfWidgetFormTextarea(),
      'id_agents'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'datenaissance' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'nordre'        => new sfWidgetFormInputText(),
      'datemajeur'    => new sfWidgetFormInputText(),
      'id_deduction'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Deductioncommune'), 'add_empty' => true)),
      'etat'          => new sfWidgetFormInputCheckbox(),
      'etudiant'      => new sfWidgetFormInputCheckbox(),
      'boursie'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'prenom'        => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'observation'   => new sfValidatorString(array('required' => false)),
      'id_agents'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'datenaissance' => new sfValidatorDate(array('required' => false)),
      'nordre'        => new sfValidatorInteger(array('required' => false)),
      'datemajeur'    => new sfValidatorInteger(array('required' => false)),
      'id_deduction'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Deductioncommune'), 'column' => 'id', 'required' => false)),
      'etat'          => new sfValidatorBoolean(array('required' => false)),
      'etudiant'      => new sfValidatorBoolean(array('required' => false)),
      'boursie'       => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('enfants[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Enfants';
  }

}
