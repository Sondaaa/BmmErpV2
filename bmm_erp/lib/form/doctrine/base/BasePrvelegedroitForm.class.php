<?php

/**
 * Prvelegedroit form base class.
 *
 * @method Prvelegedroit getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePrvelegedroitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_role'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => true)),
      'id_prevelege' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prevelege'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_role'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'required' => false)),
      'id_prevelege' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Prevelege'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('prvelegedroit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prvelegedroit';
  }

}
