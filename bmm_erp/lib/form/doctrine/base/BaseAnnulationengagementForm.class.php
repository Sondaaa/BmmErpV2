<?php

/**
 * Annulationengagement form base class.
 *
 * @method Annulationengagement getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAnnulationengagementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'date'                         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montantecart'                 => new sfWidgetFormInputText(),
      'totale'                       => new sfWidgetFormInputCheckbox(),
      'id_lignemouvementfacturation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'add_empty' => true)),
      'id_ligprotitrub'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_documentachat'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                         => new sfValidatorDate(array('required' => false)),
      'montantecart'                 => new sfValidatorNumber(array('required' => false)),
      'totale'                       => new sfValidatorBoolean(array('required' => false)),
      'id_lignemouvementfacturation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'column' => 'id', 'required' => false)),
      'id_ligprotitrub'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'id_documentachat'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('annulationengagement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Annulationengagement';
  }

}
