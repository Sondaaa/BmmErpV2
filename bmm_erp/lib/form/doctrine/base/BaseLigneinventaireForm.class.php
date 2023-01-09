<?php

/**
 * Ligneinventaire form base class.
 *
 * @method Ligneinventaire getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLigneinventaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_inventaire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inventairestock'), 'add_empty' => true)),
      'id_article'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'qtereel'       => new sfWidgetFormInputText(),
      'qtetheorique'  => new sfWidgetFormInputText(),
      'ecartreel'     => new sfWidgetFormInputText(),
      'ecartthorique' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_inventaire' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inventairestock'), 'required' => false)),
      'id_article'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'required' => false)),
      'qtereel'       => new sfValidatorNumber(array('required' => false)),
      'qtetheorique'  => new sfValidatorNumber(array('required' => false)),
      'ecartreel'     => new sfValidatorNumber(array('required' => false)),
      'ecartthorique' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneinventaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneinventaire';
  }

}
