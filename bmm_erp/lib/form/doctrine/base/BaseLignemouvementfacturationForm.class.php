<?php

/**
 * Lignemouvementfacturation form base class.
 *
 * @method Lignemouvementfacturation getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignemouvementfacturationForm extends BaseFormDoctrine
{
  public function setup()
  { $etat = array("1" => "En Régle", "0" => "En Défaut");

    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'ordre'            => new sfWidgetFormInputText(),
      'date'             => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'numerofacture'    => new sfWidgetFormInputText(),
      'montant'          => new sfWidgetFormInputText(),
      'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'rrs'              => new sfWidgetFormInputText(),
      'pvr'              => new sfWidgetFormInputText(),
      'daterrspvr'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_fournisseur'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'valide'           => new sfWidgetFormInputCheckbox(),
      'tauxpourcetage'   => new sfWidgetFormInputText(),
	  'etatfrs'          => new sfWidgetFormChoice(array('choices' => $etat)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'ordre'            => new sfValidatorInteger(array('required' => false)),
      'date'             => new sfValidatorDate(array('required' => false)),
      'numerofacture'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'montant'          => new sfValidatorNumber(array('required' => false)),
      'id_documentachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
      'rrs'              => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pvr'              => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'daterrspvr'       => new sfValidatorDate(array('required' => false)),
      'id_fournisseur'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
      'valide'           => new sfValidatorBoolean(array('required' => false)),
      'tauxpourcetage'   => new sfValidatorNumber(array('required' => false)),
	     'etatfrs'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignemouvementfacturation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemouvementfacturation';
  }

}
