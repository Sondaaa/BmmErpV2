<?php

/**
 * Docachatreg form base class.
 *
 * @method Docachatreg getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocachatregForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_docreg'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_3'), 'add_empty' => true)),
      'id_demandeur'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
      'id_bci'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_useracheteur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_docreg'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat_3'), 'required' => false)),
      'id_demandeur'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'required' => false)),
      'id_bci'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
      'id_useracheteur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('docachatreg[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Docachatreg';
  }

}
