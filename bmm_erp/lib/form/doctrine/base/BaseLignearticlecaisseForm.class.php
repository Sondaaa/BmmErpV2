<?php

/**
 * Lignearticlecaisse form base class.
 *
 * @method Lignearticlecaisse getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignearticlecaisseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'id_ligneoperationcaisse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligneoperationcaisse'), 'add_empty' => true)),
      'id_lignearticle'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_ligneoperationcaisse' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligneoperationcaisse'), 'required' => false)),
      'id_lignearticle'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignedocachat'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignearticlecaisse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignearticlecaisse';
  }

}
