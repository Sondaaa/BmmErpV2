<?php

/**
 * Entetepaie filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEntetepaieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mois'           => new sfWidgetFormFilterInput(),
      'annee'          => new sfWidgetFormFilterInput(),
      'idrh'           => new sfWidgetFormFilterInput(),
      'nomcomplet'     => new sfWidgetFormFilterInput(),
      'numaffiliation' => new sfWidgetFormFilterInput(),
      'dateembauche'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'qualification'  => new sfWidgetFormFilterInput(),
      'categorie'      => new sfWidgetFormFilterInput(),
      'echelle'        => new sfWidgetFormFilterInput(),
      'echelon'        => new sfWidgetFormFilterInput(),
      'etatcivil'      => new sfWidgetFormFilterInput(),
      'salairedebase'  => new sfWidgetFormFilterInput(),
      'id_agents'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'mois'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'annee'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idrh'           => new sfValidatorPass(array('required' => false)),
      'nomcomplet'     => new sfValidatorPass(array('required' => false)),
      'numaffiliation' => new sfValidatorPass(array('required' => false)),
      'dateembauche'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'qualification'  => new sfValidatorPass(array('required' => false)),
      'categorie'      => new sfValidatorPass(array('required' => false)),
      'echelle'        => new sfValidatorPass(array('required' => false)),
      'echelon'        => new sfValidatorPass(array('required' => false)),
      'etatcivil'      => new sfValidatorPass(array('required' => false)),
      'salairedebase'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_agents'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('entetepaie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entetepaie';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'mois'           => 'Number',
      'annee'          => 'Number',
      'idrh'           => 'Text',
      'nomcomplet'     => 'Text',
      'numaffiliation' => 'Text',
      'dateembauche'   => 'Date',
      'qualification'  => 'Text',
      'categorie'      => 'Text',
      'echelle'        => 'Text',
      'echelon'        => 'Text',
      'etatcivil'      => 'Text',
      'salairedebase'  => 'Number',
      'id_agents'      => 'ForeignKey',
    );
  }
}
