<?php

/**
 * Situationmulitaire form base class.
 *
 * @method Situationmulitaire getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSituationmulitaireForm extends BaseFormDoctrine
{
  public function setup()
  {$array=array("Effectue"=>"Effectue","Disponse"=>"Disponse","sous_contrat"=>"sous_contrat","Non Effectue"=>"Non Effectue");
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'etat'              => new sfWidgetFormChoice(array('choices' => $array)),
      'datedenutarme'     => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'datefinarme'       => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'datedesignseul'    => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'datefindesignseul' => new sfWidgetFormInputText(array(),array('type'=>'date')),
      'id_agents'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'etat'              => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'datedenutarme'     => new sfValidatorDate(array('required' => false)),
      'datefinarme'       => new sfValidatorDate(array('required' => false)),
      'datedesignseul'    => new sfValidatorDate(array('required' => false)),
      'datefindesignseul' => new sfValidatorInteger(array('required' => false)),
      'id_agents'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('situationmulitaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Situationmulitaire';
  }

}
