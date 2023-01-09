<?php

/**
 * Erphistorique form base class.
 *
 * @method Erphistorique getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseErphistoriqueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'iduser'       => new sfWidgetFormInputText(),
      'userlogin'    => new sfWidgetFormInputText(),
      'datemaj'      => new sfWidgetFormDateTime(),
      'nametable'    => new sfWidgetFormInputText(),
      'idetranger'   => new sfWidgetFormInputText(),
      'idhistorique' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'iduser'       => new sfValidatorInteger(array('required' => false)),
      'userlogin'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'datemaj'      => new sfValidatorDateTime(array('required' => false)),
      'nametable'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'idetranger'   => new sfValidatorInteger(array('required' => false)),
      'idhistorique' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('erphistorique[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Erphistorique';
  }

}
