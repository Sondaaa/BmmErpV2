<?php

/**
 * Recapdeponse form base class.
 *
 * @method Recapdeponse getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecapdeponseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'lib_rubrique'   => new sfWidgetFormTextarea(),
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'mois'           => new sfWidgetFormInputText(),
      'datecreation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'mnt_caisse'     => new sfWidgetFormInputText(),
      'mnt_banque'     => new sfWidgetFormInputText(),
      'mnt_ant'        => new sfWidgetFormInputText(),
      'id_ligprotitre' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'required' => false)),
      'lib_rubrique'   => new sfValidatorString(array('required' => false)),
      'id_titre'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
      'mois'           => new sfValidatorInteger(array('required' => false)),
      'datecreation'   => new sfValidatorDate(array('required' => false)),
      'mnt_caisse'     => new sfValidatorNumber(array('required' => false)),
      'mnt_banque'     => new sfValidatorNumber(array('required' => false)),
      'mnt_ant'        => new sfValidatorNumber(array('required' => false)),
      'id_ligprotitre' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recapdeponse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recapdeponse';
  }

}
