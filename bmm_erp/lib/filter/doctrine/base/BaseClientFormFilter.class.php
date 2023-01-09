<?php

/**
 * Client filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'        => new sfWidgetFormFilterInput(),
      'nom'              => new sfWidgetFormFilterInput(),
      'prenom'           => new sfWidgetFormFilterInput(),
      'rs'               => new sfWidgetFormFilterInput(),
      'mail'             => new sfWidgetFormFilterInput(),
      'tel'              => new sfWidgetFormFilterInput(),
      'gsm'              => new sfWidgetFormFilterInput(),
      'id_activite'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activitetiers'), 'add_empty' => true)),
      'nfiche'           => new sfWidgetFormFilterInput(),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'datecreation'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'codeclt'          => new sfWidgetFormFilterInput(),
      'observation'      => new sfWidgetFormFilterInput(),
      'id_plancomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_dossier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'reference'        => new sfValidatorPass(array('required' => false)),
      'nom'              => new sfValidatorPass(array('required' => false)),
      'prenom'           => new sfValidatorPass(array('required' => false)),
      'rs'               => new sfValidatorPass(array('required' => false)),
      'mail'             => new sfValidatorPass(array('required' => false)),
      'tel'              => new sfValidatorPass(array('required' => false)),
      'gsm'              => new sfValidatorPass(array('required' => false)),
      'id_activite'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Activitetiers'), 'column' => 'id')),
      'nfiche'           => new sfValidatorPass(array('required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'datecreation'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'codeclt'          => new sfValidatorPass(array('required' => false)),
      'observation'      => new sfValidatorPass(array('required' => false)),
      'id_plancomptable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'id_dossier'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'reference'        => 'Text',
      'nom'              => 'Text',
      'prenom'           => 'Text',
      'rs'               => 'Text',
      'mail'             => 'Text',
      'tel'              => 'Text',
      'gsm'              => 'Text',
      'id_activite'      => 'ForeignKey',
      'nfiche'           => 'Text',
      'id_user'          => 'ForeignKey',
      'datecreation'     => 'Date',
      'codeclt'          => 'Text',
      'observation'      => 'Text',
      'id_plancomptable' => 'ForeignKey',
      'id_dossier'       => 'ForeignKey',
    );
  }
}
