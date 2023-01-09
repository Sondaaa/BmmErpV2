<?php

/**
 * Typecomptebilan form base class.
 *
 * @method Typecomptebilan getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTypecomptebilanForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_typecompte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecompte'), 'add_empty' => false)),
      'id_compte'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => false)),
      'id_exercice'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'add_empty' => true)),
      'id_dossier'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_typecompte' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecompte'), 'column' => 'id')),
      'id_compte'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id')),
      'id_exercice'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Exercice'), 'column' => 'id', 'required' => false)),
      'id_dossier'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typecomptebilan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typecomptebilan';
  }

}
