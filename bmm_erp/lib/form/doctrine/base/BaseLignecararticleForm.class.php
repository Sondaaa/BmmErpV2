<?php

/**
 * Lignecararticle form base class.
 *
 * @method Lignecararticle getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignecararticleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'valeurlibelle' => new sfWidgetFormInputText(),
      'id_article'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_car'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caracteristiquearticle'), 'add_empty' => true)),
      'code'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'valeurlibelle' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'id_article'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'column' => 'id', 'required' => false)),
      'id_car'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caracteristiquearticle'), 'column' => 'id', 'required' => false)),
      'code'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignecararticle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecararticle';
  }

}
