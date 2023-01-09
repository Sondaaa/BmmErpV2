<?php

/**
 * Grilleregimehoraire form base class.
 *
 * @method Grilleregimehoraire getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGrilleregimehoraireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_regime' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'annee'     => new sfWidgetFormInputText(),
      'jour'      => new sfWidgetFormInputText(),
      'nbrheuret' => new sfWidgetFormInputText(),
      'jourrepos' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_regime' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'required' => false)),
      'annee'     => new sfValidatorInteger(array('required' => false)),
      'jour'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'nbrheuret' => new sfValidatorInteger(array('required' => false)),
      'jourrepos' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grilleregimehoraire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grilleregimehoraire';
  }

}
