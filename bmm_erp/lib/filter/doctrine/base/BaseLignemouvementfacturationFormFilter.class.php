<?php

/**
 * Lignemouvementfacturation filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignemouvementfacturationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ordre'            => new sfWidgetFormFilterInput(),
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'numerofacture'    => new sfWidgetFormFilterInput(),
      'montant'          => new sfWidgetFormFilterInput(),
      'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'rrs'              => new sfWidgetFormFilterInput(),
      'pvr'              => new sfWidgetFormFilterInput(),
      'daterrspvr'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_fournisseur'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'valide'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tauxpourcetage'   => new sfWidgetFormFilterInput(),
	  'etatfrs'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ordre'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'numerofacture'    => new sfValidatorPass(array('required' => false)),
      'montant'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_documentachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'rrs'              => new sfValidatorPass(array('required' => false)),
      'pvr'              => new sfValidatorPass(array('required' => false)),
      'daterrspvr'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_fournisseur'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'valide'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tauxpourcetage'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  
	   'etatfrs'          => new sfValidatorPass(array('required' => false)),
    
    ));

    $this->widgetSchema->setNameFormat('lignemouvementfacturation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemouvementfacturation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'ordre'            => 'Number',
      'date'             => 'Date',
      'numerofacture'    => 'Text',
      'montant'          => 'Number',
      'id_documentachat' => 'ForeignKey',
      'rrs'              => 'Text',
      'pvr'              => 'Text',
      'daterrspvr'       => 'Date',
      'id_fournisseur'   => 'ForeignKey',
      'valide'           => 'Boolean',
      'tauxpourcetage'   => 'Number',
    );
  }
}
