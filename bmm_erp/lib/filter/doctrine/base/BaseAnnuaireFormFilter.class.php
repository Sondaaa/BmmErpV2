<?php

/**
 * Annuaire filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnnuaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tel'    => new sfWidgetFormFilterInput(),
      'fax'    => new sfWidgetFormFilterInput(),
      'mail'   => new sfWidgetFormFilterInput(),
      'gsm'    => new sfWidgetFormFilterInput(),
      'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tel'    => new sfValidatorPass(array('required' => false)),
      'fax'    => new sfValidatorPass(array('required' => false)),
      'mail'   => new sfValidatorPass(array('required' => false)),
      'gsm'    => new sfValidatorPass(array('required' => false)),
      'id_frs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('annuaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annuaire';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'tel'    => 'Text',
      'fax'    => 'Text',
      'mail'   => 'Text',
      'gsm'    => 'Text',
      'id_frs' => 'ForeignKey',
    );
  }
}
