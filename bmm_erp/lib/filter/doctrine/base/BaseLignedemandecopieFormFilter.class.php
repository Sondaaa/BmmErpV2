<?php

/**
 * Lignedemandecopie filter form base class.
 *
 * @package    PhpProjectTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignedemandecopieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_demande' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandedevoirfichieradmin'), 'add_empty' => true)),
      'id_copie'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Copiedocument'), 'add_empty' => true)),
      'norde'      => new sfWidgetFormFilterInput(),
      'numero'     => new sfWidgetFormFilterInput(),
      'type'       => new sfWidgetFormFilterInput(),
      'contenu'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_demande' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandedevoirfichieradmin'), 'column' => 'id')),
      'id_copie'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Copiedocument'), 'column' => 'id')),
      'norde'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numero'     => new sfValidatorPass(array('required' => false)),
      'type'       => new sfValidatorPass(array('required' => false)),
      'contenu'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignedemandecopie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedemandecopie';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_demande' => 'ForeignKey',
      'id_copie'   => 'ForeignKey',
      'norde'      => 'Number',
      'numero'     => 'Text',
      'type'       => 'Text',
      'contenu'    => 'Text',
    );
  }
}
