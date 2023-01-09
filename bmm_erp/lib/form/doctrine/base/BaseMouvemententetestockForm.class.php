<?php

/**
 * Mouvemententetestock form base class.
 *
 * @method Mouvemententetestock getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMouvemententetestockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'exercice'    => new sfWidgetFormTextarea(),
      'libelle'     => new sfWidgetFormTextarea(),
      'id_docachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'exercice'    => new sfValidatorString(array('required' => false)),
      'libelle'     => new sfValidatorString(array('required' => false)),
      'id_docachat' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mouvemententetestock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mouvemententetestock';
  }

}
