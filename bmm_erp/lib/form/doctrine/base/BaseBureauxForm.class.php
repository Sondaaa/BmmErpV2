<?php

/**
 * Bureaux form base class.
 *
 * @method Bureaux getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseBureauxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'bureau'       => new sfWidgetFormTextarea(),
      'id_etage'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'add_empty' => true)),
      'code'         => new sfWidgetFormTextarea(),
      'id_type'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typebureaux'), 'add_empty' => true)),
      'id_mag'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_direction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'bureau'       => new sfValidatorString(array('required' => false)),
      'id_etage'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'column' => 'id', 'required' => false)),
      'code'         => new sfValidatorString(array('required' => false)),
      'id_type'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typebureaux'), 'column' => 'id', 'required' => false)),
      'id_mag'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'column' => 'id', 'required' => false)),
      'id_direction' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bureaux[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bureaux';
  }

}
