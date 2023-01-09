<?php

/**
 * Dossierexercice form base class.
 *
 * @method Dossierexercice getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDossierexerciceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_dossier'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => false)),
      'id_exercice'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'date'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'cloture'        => new sfWidgetFormInputCheckbox(),
      'datecloture'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_usercloture' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'exporte'        => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_dossier'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'))),
      'id_exercice'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'required' => false)),
      'date'           => new sfValidatorDate(array('required' => false)),
      'cloture'        => new sfValidatorBoolean(array('required' => false)),
      'datecloture'    => new sfValidatorDate(array('required' => false)),
      'id_usercloture' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'exporte'        => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dossierexercice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dossierexercice';
  }

}
