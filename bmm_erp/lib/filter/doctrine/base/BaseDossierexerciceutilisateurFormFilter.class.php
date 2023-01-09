<?php

/**
 * Dossierexerciceutilisateur filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDossierexerciceutilisateurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
      'id_utilisateur'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_dossierexercice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierexercice'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_utilisateur'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_dossierexercice' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossierexercice'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('dossierexerciceutilisateur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dossierexerciceutilisateur';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'date'               => 'Date',
      'id_utilisateur'     => 'ForeignKey',
      'id_dossierexercice' => 'ForeignKey',
    );
  }
}
