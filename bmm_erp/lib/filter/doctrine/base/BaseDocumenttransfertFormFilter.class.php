<?php

/**
 * Documenttransfert filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseDocumenttransfertFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'          => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_typetransfert' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'add_empty' => true)),
      'etat_transfert'   => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'          => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_user'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_typetransfert' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeaffectationimmo'), 'column' => 'id')),
      'etat_transfert'   => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documenttransfert_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documenttransfert';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'libelle'          => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'id_user'          => 'ForeignKey',
      'id_typetransfert' => 'ForeignKey',
      'etat_transfert'   => 'Text',
      'description'      => 'Text',
    );
  }
}
