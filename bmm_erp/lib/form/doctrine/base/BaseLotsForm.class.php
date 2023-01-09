<?php

/**
 * Lots form base class.
 *
 * @method Lots getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLotsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'nordre'                  => new sfWidgetFormInputText(),
      'objet'                   => new sfWidgetFormTextarea(),
      'totalht'                 => new sfWidgetFormInputText(),
      'rrr'                     => new sfWidgetFormInputText(),
      'totalapresrrr'           => new sfWidgetFormInputText(),
      'id_tva'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'tauxtva'                 => new sfWidgetFormInputText(),
      'ttcnet'                  => new sfWidgetFormInputText(),
      'id_frs'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_marche'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),
      'dateoservice'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datereceptionprevesoire' =>  new sfWidgetFormInputText(array(), array('type' => 'date')),
      'delaidexucution'         => new sfWidgetFormInputText(),
      'periodejustifier'        => new sfWidgetFormInputText(),
      'delaicontractuelle'      => new sfWidgetFormInputText(),
      'pireodereelexecution'    => new sfWidgetFormInputText(),
      'pirioderetard'           => new sfWidgetFormInputText(),
      'anciendateios'           =>  new sfWidgetFormInputText(array(), array('type' => 'date')),
      'delaigarantie'           => new sfWidgetFormInputText(),
	  
	  'datemaxreponse'            => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nordre'                  => new sfValidatorInteger(array('required' => false)),
      'objet'                   => new sfValidatorString(array('required' => false)),
      'totalht'                 => new sfValidatorNumber(array('required' => false)),
      'rrr'                     => new sfValidatorNumber(array('required' => false)),
      'totalapresrrr'           => new sfValidatorNumber(array('required' => false)),
      'id_tva'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'column' => 'id', 'required' => false)),
      'tauxtva'                 => new sfValidatorNumber(array('required' => false)),
      'ttcnet'                  => new sfValidatorNumber(array('required' => false)),
      'id_frs'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'id_marche'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'column' => 'id', 'required' => false)),
      'dateoservice'            => new sfValidatorDate(array('required' => false)),
      'datereceptionprevesoire' => new sfValidatorDate(array('required' => false)),
      'delaidexucution'         => new sfValidatorInteger(array('required' => false)),
      'periodejustifier'        => new sfValidatorInteger(array('required' => false)),
      'delaicontractuelle'      => new sfValidatorInteger(array('required' => false)),
      'pireodereelexecution'    => new sfValidatorInteger(array('required' => false)),
      'pirioderetard'           => new sfValidatorInteger(array('required' => false)),
      'anciendateios'           => new sfValidatorDate(array('required' => false)),
      'delaigarantie'           => new sfValidatorInteger(array('required' => false)),
	   'datemaxreponse'            => new sfValidatorDate(array('required' => false)),
	  
    ));

    $this->widgetSchema->setNameFormat('lots[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lots';
  }

}
