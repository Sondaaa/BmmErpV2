<?php

/**
 * Lignebanquecaisse form base class.
 *
 * @method Lignebanquecaisse getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignebanquecaisseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_caissebanque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
      'id_budget'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_caissebanque' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'required' => false)),
      'id_budget'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignebanquecaisse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignebanquecaisse';
  }

}
