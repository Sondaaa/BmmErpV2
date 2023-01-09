<?php

/**
 * Engagementantecedent form base class.
 *
 * @method Engagementantecedent getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseEngagementantecedentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'date'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'annee'           => new sfWidgetFormInputText(),
      'id_titre'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_ligprotitrub' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_docachat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'description'     => new sfWidgetFormTextarea(),
      'montant'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'            => new sfValidatorDate(array('required' => false)),
      'annee'           => new sfValidatorInteger(array('required' => false)),
      'id_titre'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id', 'required' => false)),
      'id_ligprotitrub' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'id_docachat'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'montant'         => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('engagementantecedent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Engagementantecedent';
  }

}
