<?php

/**
 * Document form base class.
 *
 * @method Document getObject() Returns the current form's model object
 *
 * @package    Commercial
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'numero'           => new sfWidgetFormInputText(),
      'totalht'          => new sfWidgetFormInputText(),
      'totalttc'         => new sfWidgetFormInputText(),
      'id_typedoc'       => new sfWidgetFormInputText(),
      'datedoc'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_parent'        => new sfWidgetFormInputText(),
      'id_bureau' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'totalht'          => new sfValidatorNumber(array('required' => false)),
      'totalttc'         => new sfValidatorNumber(array('required' => false)),
      'id_typedoc'       => new sfValidatorInteger(array('required' => false)),
      'datedoc'          => new sfValidatorDateTime(array('required' => false)),
      'id_user'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'id_parent'        => new sfValidatorInteger(array('required' => false)),
      'id_bureau' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

}
