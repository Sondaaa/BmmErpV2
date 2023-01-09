<?php

/**
 * Demandeprivilege form base class.
 *
 * @method Demandeprivilege getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandeprivilegeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $typedoc =array("Suppression " => "Suppression",
                   "Modification" => "Modification");
                   $etat =array("valide " => "Valide",
                   "Non Valide" => "Non Valide");
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'typedoc'        =>  new sfWidgetFormChoice(array('choices' => $typedoc)),
      'objet'          => new sfWidgetFormTextarea(),
      'id_objet'       => new sfWidgetFormTextarea(),
      'description'    => new sfWidgetFormTextarea(),
      'id_userdemande' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'etat'           => new sfWidgetFormChoice(array('choices' => $etat)),
      'valide'         => new sfWidgetFormInputCheckbox(),
      'datevalidation' => new sfWidgetFormDateTime(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typedoc'        => new sfValidatorString(array('required' => false)),
      'objet'          => new sfValidatorString(array('required' => false)),
      'id_objet'       => new sfValidatorString(array('required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'id_userdemande' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'etat'           => new sfValidatorString(array('required' => false)),
      'valide'         => new sfValidatorBoolean(array('required' => false)),
      'datevalidation' => new sfValidatorDateTime(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demandeprivilege[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandeprivilege';
  }

}
