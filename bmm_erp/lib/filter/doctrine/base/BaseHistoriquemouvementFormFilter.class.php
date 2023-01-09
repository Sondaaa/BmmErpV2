<?php

/**
 * Historiquemouvement filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoriquemouvementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {$etat = array(""=>"", "1" => "En Régle", "0" => "En Défaut");
    $this->setWidgets(array(
      'etatfrs'      => new sfWidgetFormChoice(array('choices' => $etat)),
      'id_frs'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_lignemvt'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'add_empty' => true)),
      'datecreation' =>  new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')),
                'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
    ));

    $this->setValidators(array(
      'etatfrs'      => new sfValidatorPass(array('required' => false)),
      'id_frs'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'id_lignemvt'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'column' => 'id')),
      'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)),
                                  'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('historiquemouvement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquemouvement';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'etatfrs'      => 'Text',
      'id_frs'       => 'ForeignKey',
      'id_lignemvt'  => 'ForeignKey',
      'datecreation' => 'Date',
    );
  }
}
