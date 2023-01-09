<?php

/**
 * Caiseepiecemonnaie form base class.
 *
 * @method Caiseepiecemonnaie getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCaiseepiecemonnaieForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'libelle'      => new sfWidgetFormTextarea(),
      'valeur'       => new sfWidgetFormInputText(),
      'id_piece'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Piecemonnaie'), 'add_empty' => true)),
      'id_mouvement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'      => new sfValidatorString(array('required' => false)),
      'valeur'       => new sfValidatorNumber(array('required' => false)),
      'id_piece'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Piecemonnaie'), 'required' => false)),
      'id_mouvement' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvementbanciare'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('caiseepiecemonnaie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caiseepiecemonnaie';
  }

}
