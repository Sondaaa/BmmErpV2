<?php

/**
 * Lignedemandecopie form base class.
 *
 * @method Lignedemandecopie getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignedemandecopieForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_demande' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandedevoirfichieradmin'), 'add_empty' => true)),
      'id_copie'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Copiedocument'), 'add_empty' => true)),
      'norde'      => new sfWidgetFormInputText(),
      'numero'     => new sfWidgetFormInputText(),
      'type'       => new sfWidgetFormInputText(),
      'contenu'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_demande' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandedevoirfichieradmin'), 'required' => false)),
      'id_copie'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Copiedocument'), 'required' => false)),
      'norde'      => new sfValidatorInteger(array('required' => false)),
      'numero'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contenu'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignedemandecopie[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedemandecopie';
  }

}
