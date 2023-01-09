<?php

/**
 * Lignefrsfamillesousfamille filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignefrsfamillesousfamilleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_frs'         => new sfWidgetFormFilterInput(),
      'id_famille'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Familletiers'), 'add_empty' => true)),
      'id_sousfamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamilletiers'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_frs'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_famille'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Familletiers'), 'column' => 'id')),
      'id_sousfamille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousfamilletiers'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lignefrsfamillesousfamille_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignefrsfamillesousfamille';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_frs'         => 'Number',
      'id_famille'     => 'ForeignKey',
      'id_sousfamille' => 'ForeignKey',
    );
  }
}
