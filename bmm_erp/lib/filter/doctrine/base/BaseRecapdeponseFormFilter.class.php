<?php

/**
 * Recapdeponse filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecapdeponseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'lib_rubrique'   => new sfWidgetFormFilterInput(),
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'mois'           => new sfWidgetFormFilterInput(),
      'datecreation'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'mnt_caisse'     => new sfWidgetFormFilterInput(),
      'mnt_banque'     => new sfWidgetFormFilterInput(),
      'mnt_ant'        => new sfWidgetFormFilterInput(),
      'id_ligprotitre' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id')),
      'lib_rubrique'   => new sfValidatorPass(array('required' => false)),
      'id_titre'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'mois'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datecreation'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'mnt_caisse'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnt_banque'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnt_ant'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_ligprotitre' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('recapdeponse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recapdeponse';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_rubrique'    => 'ForeignKey',
      'lib_rubrique'   => 'Text',
      'id_titre'       => 'ForeignKey',
      'mois'           => 'Number',
      'datecreation'   => 'Date',
      'mnt_caisse'     => 'Number',
      'mnt_banque'     => 'Number',
      'mnt_ant'        => 'Number',
      'id_ligprotitre' => 'ForeignKey',
    );
  }
}
