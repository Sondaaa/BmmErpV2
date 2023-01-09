<?php

/**
 * Lignecontribitionsociale form base class.
 *
 * @method Lignecontribitionsociale getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignecontribitionsocialeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_contribition' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'add_empty' => true)),
      'nordre'          => new sfWidgetFormInputText(),
      'code'            => new sfWidgetFormInputText(),
      'libelle'         => new sfWidgetFormInputText(),
      'taux'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contribition' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contribitionpatronale'), 'column' => 'id', 'required' => false)),
      'nordre'          => new sfValidatorInteger(array('required' => false)),
      'code'            => new sfValidatorInteger(array('required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'taux'            => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignecontribitionsociale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecontribitionsociale';
  }

}
