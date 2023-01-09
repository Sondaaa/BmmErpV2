<?php

/**
 * Pvrception form base class.
 *
 * @method Pvrception getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BasePvrceptionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'datepvrecptionprovisoire' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'observation'              => new sfWidgetFormTextarea(),
      'typepv'                   => new sfWidgetFormTextarea(),
      'urldocumentscan'          => new sfWidgetFormTextarea(),
      'piecejojnt'               => new sfWidgetFormTextarea(),
      'datereceptiondef'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_lots'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
      'id_user'                  => new sfWidgetFormTextarea(),
      'reserve'                  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datepvrecptionprovisoire' => new sfValidatorDate(array('required' => false)),
      'observation'              => new sfValidatorString(array('required' => false)),
      'typepv'                   => new sfValidatorString(array('required' => false)),
      'urldocumentscan'          => new sfValidatorString(array('required' => false)),
      'piecejojnt'               => new sfValidatorString(array('required' => false)),
      'datereceptiondef'         => new sfValidatorDate(array('required' => false)),
      'id_lots'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'column' => 'id', 'required' => false)),
      'id_user'                  => new sfValidatorString(array('required' => false)),
      'reserve'                  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pvrception[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pvrception';
  }

}
