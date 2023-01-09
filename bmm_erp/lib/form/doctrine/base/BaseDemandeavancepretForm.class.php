<?php

/**
 * Demandeavancepret form base class.
 *
 * @method Demandeavancepret getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDemandeavancepretForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_agents'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'datedemande'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montant'          => new sfWidgetFormInputText(),
      'id_type'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'add_empty' => true)),
      'valide'           => new sfWidgetFormInputCheckbox(),
      'dateva'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montantvavance'   => new sfWidgetFormInputText(),
      'mois'             => new sfWidgetFormInputText(),
      'montantmensuelle' => new sfWidgetFormInputText(),
      'nbrmois'          => new sfWidgetFormInputText(),
      'id_avance'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'add_empty' => true)),
      'id_pret'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'add_empty' => true)),
      'id_retenue'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Retenue'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'datedemande'      => new sfValidatorDate(array('required' => false)),
      'montant'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id_type'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeavancepret'), 'column' => 'id', 'required' => false)),
      'valide'           => new sfValidatorBoolean(array('required' => false)),
      'dateva'           => new sfValidatorDate(array('required' => false)),
      'montantvavance'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'mois'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'montantmensuelle' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'nbrmois'          => new sfValidatorInteger(array('required' => false)),
      'id_avance'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avance'), 'column' => 'id', 'required' => false)),
      'id_pret'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pret'), 'column' => 'id', 'required' => false)),
      'id_retenue'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Retenue'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demandeavancepret[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandeavancepret';
  }

}
