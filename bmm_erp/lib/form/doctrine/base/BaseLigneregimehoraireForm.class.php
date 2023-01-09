<?php

/**
 * Ligneregimehoraire form base class.
 *
 * @method Ligneregimehoraire getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneregimehoraireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_regime'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'add_empty' => true)),
      'id_dossier'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
      'designation' => new sfWidgetFormInputText(),
      'nordre'      => new sfWidgetFormInputText(),
      'pardefaut'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_regime'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regimehoraire'), 'column' => 'id', 'required' => false)),
      'id_dossier'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
      'designation' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nordre'      => new sfValidatorInteger(array('required' => false)),
      'pardefaut'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneregimehoraire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneregimehoraire';
  }

}
