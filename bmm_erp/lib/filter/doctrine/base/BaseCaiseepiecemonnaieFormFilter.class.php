<?php

/**
 * Caiseepiecemonnaie filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCaiseepiecemonnaieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'      => new sfWidgetFormFilterInput(),
      'valeur'       => new sfWidgetFormFilterInput(),
      'id_piece'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piecemonnaie'), 'add_empty' => true)),
      'id_mouvement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'add_empty' => true)),
      'qte'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'libelle'      => new sfValidatorPass(array('required' => false)),
      'valeur'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_piece'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Piecemonnaie'), 'column' => 'id')),
      'id_mouvement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mouvementbanciare'), 'column' => 'id')),
      'qte'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('caiseepiecemonnaie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caiseepiecemonnaie';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'libelle'      => 'Text',
      'valeur'       => 'Number',
      'id_piece'     => 'ForeignKey',
      'id_mouvement' => 'ForeignKey',
      'qte'          => 'Number',
    );
  }
}
