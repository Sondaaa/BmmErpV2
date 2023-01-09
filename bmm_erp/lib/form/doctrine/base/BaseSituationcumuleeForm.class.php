<?php

/**
 * Situationcumulee form base class.
 *
 * @method Situationcumulee getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseSituationcumuleeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'id_ligprotitre' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mnt_engagement' => new sfWidgetFormInputText(),
      'mnt_paiement'   => new sfWidgetFormInputText(),
      'lib_rubrique'   => new sfWidgetFormTextarea(),
      'annees'         => new sfWidgetFormInputText(),
      'mois'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_titre'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id', 'required' => false)),
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id', 'required' => false)),
      'id_ligprotitre' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'mnt_engagement' => new sfValidatorNumber(array('required' => false)),
      'mnt_paiement'   => new sfValidatorNumber(array('required' => false)),
      'lib_rubrique'   => new sfValidatorString(array('required' => false)),
      'annees'         => new sfValidatorInteger(array('required' => false)),
      'mois'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('situationcumulee[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Situationcumulee';
  }

}
