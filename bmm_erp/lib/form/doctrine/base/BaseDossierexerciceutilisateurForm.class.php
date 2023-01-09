<?php

/**
 * Dossierexerciceutilisateur form base class.
 *
 * @method Dossierexerciceutilisateur getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDossierexerciceutilisateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'date'               => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_utilisateur'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_dossierexercice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierexercice'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => false)),
      'id_utilisateur'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'id_dossierexercice' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierexercice'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dossierexerciceutilisateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dossierexerciceutilisateur';
  }

}
