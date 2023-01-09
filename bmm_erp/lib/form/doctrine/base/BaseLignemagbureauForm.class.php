<?php

/**
 * Lignemagbureau form base class.
 *
 * @method Lignemagbureau getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignemagbureauForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'id_mag' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_bur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_mag' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'column' => 'id', 'required' => false)),
      'id_bur' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignemagbureau[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemagbureau';
  }

}
