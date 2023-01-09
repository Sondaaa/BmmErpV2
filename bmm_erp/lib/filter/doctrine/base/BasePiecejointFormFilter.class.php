<?php

/**
 * Piecejoint filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePiecejointFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'chemin'                 => new sfWidgetFormFilterInput(),
      'objet'                  => new sfWidgetFormFilterInput(),
      'sujet'                  => new sfWidgetFormFilterInput(),
      'id_typepiece'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiece'), 'add_empty' => true)),
      'id_courrier'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'), 'add_empty' => true)),
      'id_parcour'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parcourcourier'), 'add_empty' => true)),
      'id_docachat'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_ordreservice'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ordredeservice'), 'add_empty' => true)),
      'id_docbudget'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentbudget'), 'add_empty' => true)),
      'id_titrebudget'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_transfert'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Transfertbudget'), 'add_empty' => true)),
      'id_orderservicecontrat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ordredeservicecontratachat'), 'add_empty' => true)),
      'id_pvreceptionmarche'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pvrception'), 'add_empty' => true)),
   'id_marche'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),
   ));

    $this->setValidators(array(
      'chemin'                 => new sfValidatorPass(array('required' => false)),
      'objet'                  => new sfValidatorPass(array('required' => false)),
      'sujet'                  => new sfValidatorPass(array('required' => false)),
      'id_typepiece'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typepiece'), 'column' => 'id')),
      'id_courrier'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Courrier'), 'column' => 'id')),
      'id_parcour'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Parcourcourier'), 'column' => 'id')),
      'id_docachat'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'id_ordreservice'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ordredeservice'), 'column' => 'id')),
      'id_docbudget'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentbudget'), 'column' => 'id')),
      'id_titrebudget'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'id_transfert'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Transfertbudget'), 'column' => 'id')),
      'id_orderservicecontrat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ordredeservicecontratachat'), 'column' => 'id')),
      'id_pvreceptionmarche'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pvrception'), 'column' => 'id')),
'id_marche'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Marches'), 'column' => 'id')),   
   ));

    $this->widgetSchema->setNameFormat('piecejoint_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Piecejoint';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'chemin'                 => 'Text',
      'objet'                  => 'Text',
      'sujet'                  => 'Text',
      'id_typepiece'           => 'ForeignKey',
      'id_courrier'            => 'ForeignKey',
      'id_parcour'             => 'ForeignKey',
      'id_docachat'            => 'ForeignKey',
      'id_ordreservice'        => 'ForeignKey',
      'id_docbudget'           => 'ForeignKey',
      'id_titrebudget'         => 'ForeignKey',
      'id_transfert'           => 'ForeignKey',
      'id_orderservicecontrat' => 'ForeignKey',
      'id_pvreceptionmarche'   => 'ForeignKey',
    );
  }
}
