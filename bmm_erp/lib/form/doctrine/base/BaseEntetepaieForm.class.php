<?php

/**
 * Entetepaie form base class.
 *
 * @method Entetepaie getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseEntetepaieForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'mois'           => new sfWidgetFormInputText(),
      'annee'          => new sfWidgetFormInputText(),
      'idrh'           => new sfWidgetFormInputText(),
      'nomcomplet'     => new sfWidgetFormInputText(),
      'numaffiliation' => new sfWidgetFormInputText(),
      'dateembauche'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'qualification'  => new sfWidgetFormInputText(),
      'categorie'      => new sfWidgetFormInputText(),
      'echelle'        => new sfWidgetFormInputText(),
      'echelon'        => new sfWidgetFormInputText(),
      'etatcivil'      => new sfWidgetFormInputText(),
      'salairedebase'  => new sfWidgetFormInputText(),
      'id_agents'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mois'           => new sfValidatorInteger(array('required' => false)),
      'annee'          => new sfValidatorInteger(array('required' => false)),
      'idrh'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nomcomplet'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'numaffiliation' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dateembauche'   => new sfValidatorDate(array('required' => false)),
      'qualification'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'categorie'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'echelle'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'echelon'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'etatcivil'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'salairedebase'  => new sfValidatorNumber(array('required' => false)),
      'id_agents'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('entetepaie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entetepaie';
  }

}
