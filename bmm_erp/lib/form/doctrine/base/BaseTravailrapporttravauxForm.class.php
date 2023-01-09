<?php

/**
 * Travailrapporttravaux form base class.
 *
 * @method Travailrapporttravaux getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTravailrapporttravauxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'libelle'           => new sfWidgetFormTextarea(),
      'montant'           => new sfWidgetFormInputText(),
      'id_rapporttravaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'           => new sfValidatorString(array('required' => false)),
      'montant'           => new sfValidatorNumber(array('required' => false)),
      'id_rapporttravaux' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rapporttravaux'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('travailrapporttravaux[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Travailrapporttravaux';
  }

}
