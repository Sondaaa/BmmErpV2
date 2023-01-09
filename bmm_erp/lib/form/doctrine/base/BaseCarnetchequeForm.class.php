<?php

/**
 * Carnetcheque form base class.
 *
 * @method Carnetcheque getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCarnetchequeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'refdepart'  => new sfWidgetFormInputText(),
      'reffin'     => new sfWidgetFormInputText(),
      'id_banque'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => false)),
      'daterecu'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'nbrepapier' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'refdepart'  => new sfValidatorNumber(),
      'reffin'     => new sfValidatorNumber(),
      'id_banque'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
      'daterecu'   => new sfValidatorDate(),
      'nbrepapier' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('carnetcheque[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carnetcheque';
  }

}
