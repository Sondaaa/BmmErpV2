<?php

/**
 * Rubriqueformation form base class.
 *
 * @method Rubriqueformation getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRubriqueformationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'code'       => new sfWidgetFormInputText(),
      'libelle'    => new sfWidgetFormInputText(),
      'id_domaine' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Domaineuntilisation'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'libelle'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_domaine' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Domaineuntilisation'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rubriqueformation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rubriqueformation';
  }

}
